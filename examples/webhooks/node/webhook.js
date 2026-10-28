/*
 * QUANTEX API - webhook receiver (Node.js 18+, no packages needed)
 *
 * QUANTEX POSTs every new signal (signal.created) and its result (signal.result)
 * to your https:// address. This server checks the signature and forwards the
 * signal to your Telegram channel.
 *
 * Run
 *   export QX_WEBHOOK_SECRET="whsec_..."   (shown once when you add the webhook)
 *   export TG_BOT_TOKEN="123456:ABC..."    (optional: post to Telegram)
 *   export TG_CHAT="@your_channel"         (optional)
 *   node webhook.js                        listens on port 8000, path /quantex
 * Then put it behind https (nginx, Caddy, Cloudflare Tunnel ...) and add
 * https://your-domain/quantex in Dashboard -> API -> Webhooks.
 */
const http = require("http");
const crypto = require("crypto");

const SECRET = process.env.QX_WEBHOOK_SECRET;
const { TG_BOT_TOKEN, TG_CHAT } = process.env;
const seen = new Set(); // delivery ids already handled (retries send the same id)

/** X-Quantex-Signature: t=<unix time>,v1=<hex HMAC-SHA256 of "<t>.<raw body>"> */
function validSignature(raw, header = "") {
  const parts = Object.fromEntries(header.split(",").map((p) => p.split("=", 2)));
  const t = parts.t || "", sig = parts.v1 || "";
  if (!/^\d+$/.test(t) || Math.abs(Date.now() / 1000 - Number(t)) > 300) return false; // older than 5 minutes
  const expected = crypto.createHmac("sha256", SECRET).update(`${t}.`).update(raw).digest("hex");
  return sig.length === expected.length && crypto.timingSafeEqual(Buffer.from(sig), Buffer.from(expected));
}

http.createServer((req, res) => {
  if (req.method !== "POST" || req.url !== "/quantex") { res.writeHead(404).end(); return; }
  const chunks = [];
  req.on("data", (c) => chunks.push(c));
  req.on("end", async () => {
    const raw = Buffer.concat(chunks); // the raw bytes: the signature is made over them
    if (!validSignature(raw, req.headers["x-quantex-signature"])) { res.writeHead(401).end(); return; }
    const delivery = req.headers["x-quantex-delivery"];
    res.writeHead(200).end(); // answer 2xx within 5 seconds, then do the work
    if (seen.has(delivery)) return;
    seen.add(delivery);

    const event = JSON.parse(raw);
    const s = event.data;
    let text;
    if (event.type === "signal.created") {
      text = `📊 ${s.pair} ${s.timeframe} ${s.direction} - entry ${s.entry_at.slice(11, 16)} UTC, payout ${s.payout}%`;
    } else if (event.type === "signal.result") {
      text = `${s.pair} ${s.direction}: ${s.result}` + (s.mtg_level ? ` (MTG ${s.mtg_level})` : "");
    } else {
      text = "QUANTEX webhook test received ✅"; // "ping" from the Send test button
    }
    console.log(text);
    if (TG_BOT_TOKEN && TG_CHAT) {
      await fetch(`https://api.telegram.org/bot${TG_BOT_TOKEN}/sendMessage`, {
        method: "POST", headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ chat_id: TG_CHAT, text }),
      }).catch((e) => console.error("telegram:", e.message));
    }
  });
}).listen(Number(process.env.PORT || 8000), () => console.log("Waiting for QUANTEX webhooks on /quantex"));
