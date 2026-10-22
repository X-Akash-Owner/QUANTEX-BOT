/*
 * QUANTEX API - server for index.html (Node.js 18+, no packages needed)
 *
 * Serves index.html and the data it needs. Your key stays on the server.
 * Answers are cached for a moment, so 1 or 1000 visitors make the same few API requests.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   node server.js                       then open http://localhost:8000
 */
const http = require("http");
const fs = require("fs");
const path = require("path");

const QX_API = process.env.QX_API || "https://api.quantexbot.pro/v1";
const KEY = process.env.QX_API_KEY;
const BROKER = process.env.QX_BROKER || "quotex"; // quotex or tradowix (live ticks)
const cache = new Map();

/** GET from the QUANTEX API, cached and shared by all visitors. */
async function quantex(apiPath, params, cacheSeconds) {
  const url = `${QX_API}${apiPath}?${new URLSearchParams(params)}`;
  const hit = cache.get(url);
  if (hit && Date.now() - hit.at < cacheSeconds * 1000) return hit.data;
  const body = await (await fetch(url, { headers: { Authorization: `Bearer ${KEY}` } })).json();
  if (!body.ok) throw new Error(body.error.message);
  cache.set(url, { at: Date.now(), data: body.data });
  return body.data;
}

async function api(q) {
  // Only accept what the page needs: nobody can use your key for anything else.
  const pair = /^[A-Za-z0-9_]{3,30}$/.test(q.get("pair") || "") ? q.get("pair") : null;
  const tf = ["M1", "M5", "M15", "M30", "H1", "H4"].includes(q.get("tf")) ? q.get("tf") : "M1";
  const limit = Math.max(1, Math.min(1000, Number(q.get("limit")) || 500));
  const what = q.get("do");
  if (what === "pairs") {
    const pairs = await quantex("/pairs", { broker: BROKER, open: "true" }, 60);
    return [...pairs].sort((a, b) => (b.payout || 0) - (a.payout || 0)).map((p) => ({ symbol: p.symbol, name: p.name, payout: p.payout }));
  }
  if ((what === "candles" || what === "tick") && !pair) throw new Error("pair missing");
  if (what === "candles") {
    const data = await quantex("/candles", { broker: BROKER, pair, tf, limit }, 5);
    return data.candles.map((c) => [c.epoch, c.open, c.high, c.low, c.close]);
  }
  if (what === "tick") return (await quantex("/ticks", { broker: BROKER, pairs: pair }, 0.4)).ticks[0];
  throw new Error("unknown request");
}

http.createServer(async (req, res) => {
  const url = new URL(req.url, "http://localhost");
  if (url.pathname === "/") {
    res.writeHead(200, { "Content-Type": "text/html; charset=utf-8" });
    fs.createReadStream(path.join(__dirname, "index.html")).pipe(res);
    return;
  }
  if (url.pathname !== "/api.php") { res.writeHead(404).end(); return; } // same address as the PHP version
  let out;
  try {
    out = { ok: true, data: await api(url.searchParams) };
  } catch (e) {
    out = { ok: false, error: e.message };
  }
  res.writeHead(200, { "Content-Type": "application/json", "Cache-Control": "no-store" });
  res.end(JSON.stringify(out));
}).listen(Number(process.env.PORT || 8000), () => console.log("Open http://localhost:" + (process.env.PORT || 8000)));
