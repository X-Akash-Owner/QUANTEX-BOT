/*
 * QUANTEX API - download historical candles to a CSV file (Node.js 18+, no packages needed)
 *
 * GET /v1/history gives every closed candle of whole UTC days. M1 allows 7 days
 * per request, M5 and higher 31 days, so a long range is fetched in parts.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   node export.js EURUSD_otc M1 2026-09-01 2026-09-30
 *   -> EURUSD_otc_M1_2026-09-01_2026-09-30.csv
 */
const fs = require("fs");

const QX_API = process.env.QX_API || "https://api.quantexbot.pro/v1";
const KEY = process.env.QX_API_KEY;
const BROKER = process.env.QX_BROKER || "quotex";
const [pair, tfArg, first, last] = process.argv.slice(2);
if (!last) {
  console.error("Use: node export.js PAIR TIMEFRAME FROM TO   e.g. EURUSD_otc M1 2026-09-01 2026-09-30");
  process.exit(1);
}
const tf = tfArg.toUpperCase();
const step = tf === "M1" ? 7 : 31; // days per request
const DAY = 86400000;
const iso = (ms) => new Date(ms).toISOString().slice(0, 10);
const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

(async () => {
  const out = `${pair}_${tf}_${first}_${last}.csv`;
  const file = fs.createWriteStream(out);
  file.write("time_utc,epoch,open,high,low,close,payout,volume\n");
  let day = Date.parse(first);
  const end = Date.parse(last);
  let total = 0;
  while (day <= end) {
    const to = Math.min(day + (step - 1) * DAY, end);
    const url = new URL(`${QX_API}/history`);
    url.search = new URLSearchParams({ broker: BROKER, pair, tf, from: iso(day), to: iso(to) });
    const res = await fetch(url, { headers: { Authorization: `Bearer ${KEY}` } });
    if (res.status === 429) { // too many requests: wait and ask again
      await sleep(Number(res.headers.get("Retry-After") || 5) * 1000);
      continue;
    }
    const answer = await res.json();
    if (!answer.ok) {
      console.error(`Error ${answer.error.code}: ${answer.error.message}`);
      process.exit(1);
    }
    for (const c of answer.data.candles) {
      file.write([c.time, c.epoch, c.open, c.high, c.low, c.close, c.payout ?? "", c.volume].join(",") + "\n");
    }
    total += answer.data.count;
    console.log(`${iso(day)} .. ${iso(to)}: ${answer.data.count} candles`);
    day = to + DAY;
  }
  file.end();
  console.log(`Saved ${total} candles to ${out}`);
})();
