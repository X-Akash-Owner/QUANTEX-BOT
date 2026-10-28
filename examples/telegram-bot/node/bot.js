/*
 * QUANTEX API - complete Telegram bot (Node.js 18+, no packages needed)
 *
 * Commands
 *   /pairs                       best paying open OTC pairs
 *   /price EURUSD_otc            newest live tick of a pair
 *   /candles EURUSD_otc M5 10    the last candles of a pair
 *   /check  (+ your list)        WIN / LOSS of a signal list (result checker)
 *   /results                     today's results of the QUANTEX live signals
 *   /news                        today's high impact news with direction
 *   /future 18:00 22:00          a future signal list
 *   /live on | /live off         post every QUANTEX live signal and its result here
 *
 * Run
 *   export QX_API_KEY="qx_live_..."        (Windows: set QX_API_KEY=qx_live_...)
 *   export TG_BOT_TOKEN="123456:ABC..."    (from @BotFather)
 *   node bot.js
 */
const fs = require("fs");

const QX_API = process.env.QX_API || "https://api.quantexbot.pro/v1";
const QX_KEY = process.env.QX_API_KEY;
const TG_API = (process.env.TG_API || "https://api.telegram.org") + "/bot" + process.env.TG_BOT_TOKEN;
const BROKER = process.env.QX_BROKER || "quotex"; // quotex, tradowix or binolla
const TZ = Number(process.env.QX_TZ || 6);         // your UTC offset, e.g. 6 for Bangladesh
const SUBSCRIBERS_FILE = "subscribers.json";
if (!QX_KEY || !process.env.TG_BOT_TOKEN) throw new Error("Set QX_API_KEY and TG_BOT_TOKEN first.");

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

class QuantexError extends Error {}

// ---------------------------------------------------------------- QUANTEX API
/** Call the QUANTEX API and return `data`, or throw QuantexError. */
async function qx(method, path, params = {}, body = null) {
  const url = new URL(QX_API + path);
  for (const [k, v] of Object.entries(params)) url.searchParams.set(k, v);
  for (let attempt = 0; attempt < 3; attempt++) {
    const res = await fetch(url, {
      method,
      headers: { Authorization: `Bearer ${QX_KEY}`, "Content-Type": "application/json" },
      body: body ? JSON.stringify(body) : undefined,
      signal: AbortSignal.timeout(30000),
    });
    if (res.status === 429 && attempt < 2) { // rate limit: wait as told, then retry
      await sleep(Number(res.headers.get("Retry-After") || 5) * 1000);
      continue;
    }
    const answer = await res.json();
    if (answer.ok) return answer.data;
    throw new QuantexError(`${answer.error.code}: ${answer.error.message}`);
  }
}

// ---------------------------------------------------------------- Telegram
async function tg(method, params = {}) {
  const res = await fetch(`${TG_API}/${method}`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(params),
    signal: AbortSignal.timeout(40000),
  });
  return (await res.json()).result;
}

async function reply(chatId, text, replyTo) {
  let msg;
  for (let i = 0; i < text.length; i += 4000) { // Telegram allows 4096 characters
    msg = await tg("sendMessage", {
      chat_id: chatId, text: text.slice(i, i + 4000),
      reply_to_message_id: replyTo, allow_sending_without_reply: true,
    });
  }
  return msg;
}

// ---------------------------------------------------------------- helpers
/** "2026-10-05T10:31:00Z" -> "16:31" in your timezone. */
function localTime(iso) {
  const t = new Date(Date.parse(iso) + TZ * 3600000);
  return t.toISOString().slice(11, 16);
}
const arrow = (d) => (d === "CALL" || d === "BUY" ? "🟢 CALL" : "🔴 PUT");
function resultIcon(result, level = 0) {
  if (result === "WIN") return level ? `✅ WIN (MTG ${level})` : "✅ WIN";
  return { LOSS: "❌ LOSS", NO_DATA: "⚪ NO DATA" }[result] || result;
}

// ---------------------------------------------------------------- commands
const HELP = `QUANTEX bot
/pairs - best paying open OTC pairs
/price EURUSD_otc - live price
/candles EURUSD_otc M5 10 - last candles
/check + your list on the next lines - WIN / LOSS
/results - today's QUANTEX results
/news - high impact news today
/future 18:00 22:00 - future signal list
/live on | /live off - live signals in this chat`;

const commands = {
  start: async () => HELP,
  help: async () => HELP,

  async pairs() {
    const pairs = await qx("GET", "/payouts", { broker: BROKER, market: "otc" });
    const lines = pairs.filter((p) => p.open).slice(0, 15).map((p) => `${p.name.padEnd(18)} ${p.payout}%`);
    return lines.length ? "Best payouts now:\n" + lines.join("\n") : "No open pair right now.";
  },

  async price(args) {
    if (!args[0]) return "Write: /price EURUSD_otc";
    const data = await qx("GET", "/ticks", { broker: BROKER, pairs: args[0] });
    const t = data.ticks[0];
    if (!t.available) return `${args[0]}: no live price right now.`;
    let out = `${t.symbol}  ${t.price}\n${localTime(t.time)} (your time)`;
    if (t.candle) out += `\nM1 candle: O ${t.candle.open}  H ${t.candle.high}  L ${t.candle.low}  · ${t.candle.seconds_left}s left`;
    return out;
  },

  async candles(args) {
    if (!args[0]) return "Write: /candles EURUSD_otc M5 10";
    const [pair, tf = "M1", limit = "10"] = args;
    const data = await qx("GET", "/candles", { broker: BROKER, pair, tf: tf.toUpperCase(), limit: Math.min(Number(limit), 30) });
    const lines = data.candles.map((c) => `${localTime(c.time)} ${c.close >= c.open ? "🟢" : "🔴"} O ${c.open}  C ${c.close}`);
    const ups = data.candles.filter((c) => c.close >= c.open).length;
    return `${pair} ${tf.toUpperCase()} - last ${lines.length} candles (${ups} up, ${lines.length - ups} down)\n` + lines.join("\n");
  },

  async check(args, text) {
    // Everything after the first line is the list, e.g. "M1 EURUSD-OTC 14:05 CALL"
    const signals = text.split("\n").slice(1).join("\n").trim();
    if (!signals) return "Send /check and your list on the next lines:\n/check\nM1 EURUSD-OTC 14:05 CALL\nM1 USDJPY-OTC 14:20 PUT";
    const data = await qx("POST", "/checker", {}, { broker: BROKER, text: signals, mtg: 1, date: "today", timezone: TZ });
    const lines = data.results.map((r) => `${r.time} ${r.pair} ${arrow(r.direction)} → ${resultIcon(r.result, r.mtg_level || 0)}`);
    const s = data.summary;
    lines.push(`\nWins ${s.wins} · Losses ${s.losses} · Win rate ${s.win_rate}%`);
    if (data.rejected && data.rejected.length) lines.push(`Not understood: ${data.rejected.length} line(s)`);
    return lines.join("\n");
  },

  async results() {
    const data = await qx("GET", "/results", { broker: BROKER });
    const s = data.summary;
    if (!s.total) return `No settled QUANTEX signal yet on ${data.date} (UTC).`;
    return `QUANTEX live signals ${data.date} (UTC)\n` +
      `Signals ${s.total} · Wins ${s.wins} · MTG wins ${s.mtg_wins} · Losses ${s.losses}\n` +
      `Win rate ${s.win_rate}% (direct ${s.win_rate_no_mtg}%)`;
  },

  async news() {
    const data = await qx("GET", "/news", { impact: "high", days: 1, timezone: TZ });
    const lines = data.events.map((e) => `${localTime(e.time)} ${e.currency} ${{ bullish: "⬆️", bearish: "⬇️" }[e.bias] || "•"} ${e.title}`);
    return lines.length ? "High impact news today:\n" + lines.join("\n") : "No high impact news left today.";
  },

  async future(args) {
    const [start = "00:00", end = "23:59"] = args;
    let job = await qx("POST", "/future", {}, { mode: "otc", broker: BROKER, start, end, timezone: TZ, system: 1, strategy: 1, quantity: 2 });
    for (let i = 0; i < 30 && !["done", "failed"].includes(job.status); i++) { // usually ready in a few seconds
      await sleep(2000);
      job = await qx("GET", `/jobs/${job.id}`);
    }
    if (job.status !== "done") return "The list is not ready: " + ((job.error && job.error.message) || job.status);
    const lines = job.result.signals.map((s) => `${s.time} ${s.pair} ${arrow(s.direction)}`);
    return lines.length ? `Future signals ${start}-${end}:\n` + lines.join("\n") : "No signal in this time range.";
  },

  async live(args, text, chatId) {
    const subs = loadSubscribers();
    if ((args[0] || "").toLowerCase() === "off") subs.delete(chatId);
    else subs.add(chatId);
    saveSubscribers(subs);
    return subs.has(chatId)
      ? "Live signals are on. Every new QUANTEX signal and its result is posted here."
      : "Live signals stopped for this chat.";
  },
};

async function handle(message) {
  const text = message.text || "";
  if (!text.startsWith("/")) return;
  const chatId = message.chat.id;
  const [first, ...args] = text.split("\n")[0].trim().split(/\s+/);
  const name = first.slice(1).split("@")[0].toLowerCase();
  let answer;
  try {
    answer = commands[name] ? await commands[name](args, text, chatId) : "Unknown command. Send /help";
  } catch (e) {
    answer = e instanceof QuantexError ? `⚠️ ${e.message}` : `⚠️ Try again in a moment (${e.name})`;
  }
  await reply(chatId, answer, message.message_id);
}

// ---------------------------------------------------------------- live signals
function loadSubscribers() {
  try { return new Set(JSON.parse(fs.readFileSync(SUBSCRIBERS_FILE, "utf8"))); } catch { return new Set(); }
}
function saveSubscribers(subs) {
  fs.writeFileSync(SUBSCRIBERS_FILE, JSON.stringify([...subs]));
}

async function liveSignalsLoop() {
  let cursor = null;
  const posted = new Map(); // signal id -> { chat id: message id }
  for (;;) {
    try {
      const params = { broker: BROKER };
      if (cursor !== null) params.since = cursor;
      const data = await qx("GET", "/signals/live", params);
      if (cursor !== null) { // the first answer only sets the cursor
        const subs = loadSubscribers();
        for (const ev of data.events) {
          const s = ev.signal;
          if (ev.type === "signal.created") {
            const text = `📊 ${s.pair} · ${s.timeframe}\n${arrow(s.direction)}\n` +
              `Entry ${localTime(s.entry_at)} · Payout ${s.payout}% · Confidence ${s.confidence}%`;
            const ids = {};
            for (const c of subs) ids[c] = ((await reply(c, text)) || {}).message_id;
            posted.set(s.id, ids);
          } else if (ev.type === "signal.result") {
            const ids = posted.get(s.id) || {};
            posted.delete(s.id);
            for (const c of subs) await reply(c, `${s.pair} ${s.direction} → ${resultIcon(s.result, s.mtg_level || 0)}`, ids[c]);
          }
        }
      }
      cursor = data.next_cursor;
    } catch (e) {
      console.error("signals:", e.message);
    }
    await sleep(3000);
  }
}

// ---------------------------------------------------------------- main
async function main() {
  const me = await tg("getMe");
  console.log(`Bot @${me.username} is running. Press Ctrl+C to stop.`);
  liveSignalsLoop();
  let offset = 0;
  for (;;) {
    let updates;
    try {
      updates = (await tg("getUpdates", { offset, timeout: 25 })) || [];
    } catch {
      await sleep(3000);
      continue;
    }
    for (const u of updates) {
      offset = u.update_id + 1;
      if (u.message) handle(u.message).catch((e) => console.error(e));
    }
  }
}

main();
