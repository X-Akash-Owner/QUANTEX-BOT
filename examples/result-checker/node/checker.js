/*
 * QUANTEX API - result checker from a file (Node.js 18+, no packages needed)
 *
 * Reads signals.txt (one signal per line, e.g. "M1 EURUSD-OTC 14:05 CALL"),
 * checks every signal with POST /v1/checker and writes results.csv.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   node checker.js                      today, times in UTC+6
 *   node checker.js 2026-10-04 5.5       another day and timezone
 */
const fs = require("fs");

const QX_API = process.env.QX_API || "https://api.quantexbot.pro/v1";
const KEY = process.env.QX_API_KEY;
const day = process.argv[2] || "today";        // today, yesterday or YYYY-MM-DD (30 days back)
const tz = Number(process.argv[3] || 6);       // UTC offset of the times in the list

(async () => {
  const text = fs.readFileSync("signals.txt", "utf8");
  const res = await fetch(`${QX_API}/checker`, {
    method: "POST",
    headers: { Authorization: `Bearer ${KEY}`, "Content-Type": "application/json" },
    body: JSON.stringify({ broker: "quotex", text, mtg: 1, date: day, timezone: tz }),
  });
  const answer = await res.json();
  if (!answer.ok) {
    console.error(`Error ${answer.error.code}: ${answer.error.message}`);
    process.exit(1);
  }

  const data = answer.data;
  console.log(`${"TIME".padEnd(6)} ${"PAIR".padEnd(14)} ${"DIR".padEnd(5)} RESULT`);
  for (const x of data.results) {
    const mtg = x.result === "WIN" && x.mtg_level ? ` (MTG ${x.mtg_level})` : "";
    console.log(`${x.time.padEnd(6)} ${x.pair.padEnd(14)} ${x.direction.padEnd(5)} ${x.result}${mtg}`);
  }
  const s = data.summary;
  console.log(`\nTotal ${s.total} | Wins ${s.wins} | Losses ${s.losses} | No data ${s.no_data} | Win rate ${s.win_rate}%`);
  for (const line of data.rejected) console.log("Not understood:", line);

  const rows = [["time", "pair", "direction", "timeframe", "result", "mtg_level", "payout"]];
  for (const x of data.results) rows.push([x.time, x.pair, x.direction, x.timeframe, x.result, x.mtg_level ?? "", x.payout ?? ""]);
  fs.writeFileSync("results.csv", rows.map((r) => r.join(",")).join("\n") + "\n");
  console.log("Saved results.csv");
})();
