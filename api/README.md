<sub>[🏠 Home](../README.md) · [📚 Docs](../docs/README.md) · [📘 User Guide](../docs/user-guide.md) · [🤖 Auto Trading](../docs/guide/14-auto-trading.md) · [🧩 Studio](../docs/studio.md) · [🔌 API](README.md) · [💰 Pricing](../docs/pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

<div align="center">

# 🔌 QUANTEX Developer API

**Market data for your own apps, charts and bots: brokers, pairs, payouts, OHLC candles (M1 → H4), historical candles and live ticks of QUOTEX, TRADOWIX and BINOLLA.**

[![Website](https://img.shields.io/badge/Website-quantexbot.pro-2f6bff?style=flat-square)](https://quantexbot.pro)
[![API Docs](https://img.shields.io/badge/API%20Docs-quantexbot.pro%2Fdocs%2Fapi-8b5cf6?style=flat-square)](https://quantexbot.pro/docs/api)
[![Base URL](https://img.shields.io/badge/Base%20URL-api.quantexbot.pro%2Fv1-00b894?style=flat-square)](https://api.quantexbot.pro/v1/status)
[![OpenAPI](https://img.shields.io/badge/OpenAPI-3.1-6BA539?style=flat-square&logo=openapiinitiative&logoColor=white)](https://api.quantexbot.pro/v1/openapi.json)
[![Status](https://img.shields.io/badge/Status-quantexbot.pro%2Fstatus-00ff88?style=flat-square)](https://quantexbot.pro/status)

</div>

---

## 🧭 At a glance

| | |
|---|---|
| **Base URL** | `https://api.quantexbot.pro/v1` |
| **Format** | JSON over HTTPS, always `{"ok", "data" \| "error", "meta"}` |
| **Authentication** | `Authorization: Bearer qx_live_…` (keys are created in [Dashboard → API keys](https://quantexbot.pro/dashboard/api/keys)) |
| **Get a key** | [Create an account](https://quantexbot.pro/register) → verify email → Dashboard → API keys (free Developer plan included) |
| **Plans** | Developer (free), Candle Basic, Candle Data API, Full Market Data API — see [Plans](#plans) and [quantexbot.pro/pricing](https://quantexbot.pro/pricing) |
| **Machine-readable** | [OpenAPI 3.1](https://api.quantexbot.pro/v1/openapi.json) · [llms.txt](https://quantexbot.pro/llms.txt) · [full Markdown](https://quantexbot.pro/docs/api.md) · copy in this repo: [`api/openapi.json`](openapi.json) |
| **Live status** | [quantexbot.pro/status](https://quantexbot.pro/status) · JSON: [`GET /v1/status`](https://api.quantexbot.pro/v1/status) (no key) |
| **Code examples** | [`examples/`](../examples/) — live candle chart and CSV export in Python, Node.js and PHP |

### What you can build

- 📈 **Live candle charts** on your own website that move with every tick, like the broker's.
- 📊 **Dashboards and analytics** — the payout of every pair, OHLC candles M1 → H4, open markets.
- 🧪 **Backtests** — download every closed candle of any date range as CSV.
- 🤖 **Your own bots** — feed your strategy with the same market data QUANTEX uses.

### Endpoints

| Method | Path | What it does | Group |
|---|---|---|---|
| GET | `/v1/status` | API, data feed, bot and payment status + incidents (no key) | public |
| GET | `/v1/account` | Your plan, limits, usage and the key in use | account |
| GET | `/v1/usage` | Requests per day and per endpoint | account |
| GET | `/v1/brokers` | QUOTEX, TRADOWIX, BINOLLA and whether their feed is live | markets |
| GET | `/v1/pairs` | Pairs of a broker: OTC / Live, category, open now, payout | markets |
| GET | `/v1/payouts` | Current payout % of every pair | payouts |
| GET | `/v1/candles` | OHLC candles M1–H4 (closed candles only), activity volume, payout | candles |
| GET | `/v1/history` | Historical candles of a range of UTC days | history |
| GET | `/v1/ticks` | The latest tick of up to 20 pairs | ticks |
| GET | `/v1/stream/ticks` | Server-Sent Events stream of live ticks | ticks |
| GET | `/v1/openapi.json` | This API as OpenAPI 3.1 (no key) | public |

> [!NOTE]
> The signal endpoints (live signals and results, future lists, checker, news, webhooks, signal stream) are not offered at the moment. QUANTEX signals are delivered in the [Telegram bot](https://t.me/QuantexBinaryTools_bot), on the website and in the app.

---

## Introduction

The QUANTEX API gives your apps, charts and Telegram bots the same market data QUANTEX uses: the brokers and their OTC / Live pairs, current payouts, OHLC candles (M1 to H4), historical candles and live ticks. Every endpoint, parameter and example is listed in the **Endpoint reference** below.


> Binary options trading carries high risk. Data from the API is analysis, not a guarantee.

## Quick start

1. [Create an account](https://quantexbot.pro/register) and confirm your email address.
2. Open **Dashboard → API keys**, create a key and copy it (it is shown only once).
3. Make your first request:

```bash
curl "https://api.quantexbot.pro/v1/pairs?broker=quotex&market=otc&open=true" \
  -H "Authorization: Bearer qx_live_YOUR_KEY"
```

The answer is JSON:

```json
{"ok": true, "data": [{"symbol": "EURUSD_otc", "name": "EUR/USD (OTC)", "market": "otc", "category": "currency", "open": true, "payout": 87, "updated_at": "2026-10-05T10:00:00Z"}], "meta": {"request_id": "req_…", "broker": "quotex", "count": 1}}
```

## Testing in the browser

A browser address bar cannot send headers, so for a quick test of a **GET** endpoint you can put the key in the address instead (`api_key=`). Paste the address into the browser and press Enter — the answer is shown as readable JSON:

```
https://api.quantexbot.pro/v1/pairs?broker=quotex&market=otc&open=true&api_key=qx_live_YOUR_KEY
```

More addresses to try:

```
https://api.quantexbot.pro/v1/payouts?broker=quotex&min=85&api_key=qx_live_YOUR_KEY
https://api.quantexbot.pro/v1/candles?broker=quotex&pair=EURUSD_otc&tf=M1&limit=5&api_key=qx_live_YOUR_KEY
https://api.quantexbot.pro/v1/account?api_key=qx_live_YOUR_KEY
```

- Works for **GET** requests only. POST endpoints need the header (use the Python or Node.js example, or a tool such as Postman).
- A key in an address is saved in the browser history and can appear in logs. Use a **separate test key** with only the permissions it needs, and never put `api_key=` in apps, bots or shared links — send the header there.
- `https://api.quantexbot.pro/v1/status` needs no key at all.

## Authentication

Send your API key in the `Authorization` header of every request:

```
Authorization: Bearer qx_live_<prefix>_<secret>
```

`GET /v1/status` and `GET /v1/openapi.json` need no key. Never put a key in front-end code, a public repository, a chat or a screenshot — anyone with the key can use your quota.

## API keys

- Create and manage keys in **Dashboard → API keys**. The number of keys depends on your plan.
- **Permissions:** give each key only what it needs (for example `markets:read`, `payouts:read`, `candles:read`).
- **Allowed IP addresses:** optionally limit a key to your server's IP addresses or ranges.
- **Expiry:** optionally let a key expire after 30, 90, 180 or 365 days.
- **New secret:** replaces the secret and keeps the settings; the old secret stops working at once.
- **Revoke:** stops a key for good. If a key ever leaks, revoke it and create a new one.

QUANTEX stores only a hash of each key, so a lost key cannot be shown again — create a new one.

## Base URL and versioning

```
https://api.quantexbot.pro/v1
```

The version is part of the path. A change that would break existing code gets a new version (`/v2`) and `/v1` keeps working for a while. Times are always UTC (ISO 8601, e.g. `2026-10-05T10:00:00Z`).

## Response format

Every response is JSON with the same envelope.

A successful response:

```json
{"ok": true, "data": {}, "meta": {"request_id": "req_…"}}
```

An error response:

```json
{"ok": false, "error": {"code": "validation_failed", "message": "Some parameters are invalid.", "fields": {"pair": ["The pair field is required."]}}, "meta": {"request_id": "req_…"}}
```

Always check `ok` first. When `ok` is `false`, `error.code` tells you what went wrong. Quote `meta.request_id` (also in the `X-Request-Id` header) when you contact support. All error codes are listed in the reference below.

## Rate limits

Each plan has a number of requests per minute and per month for the whole account (all keys together). See the [pricing](https://quantexbot.pro/pricing) page for the plans.

Every answer tells you where you stand:

| Header | Meaning |
|---|---|
| `X-RateLimit-Limit` | requests allowed per minute |
| `X-RateLimit-Remaining` | requests left this minute |
| `X-Quota-Limit` | requests allowed this month |
| `X-Quota-Remaining` | requests left this month (resets on the 1st, UTC) |

When a limit is reached the API answers `429` (`rate_limited` or `quota_exceeded`) with a `Retry-After` header in seconds. Wait that long before trying again. Data is cached for a few seconds, so asking for the same thing more often than every 5–10 seconds only uses quota.

## Examples

Python (requests):

```python
import requests

API = "https://api.quantexbot.pro/v1"
HEADERS = {"Authorization": "Bearer qx_live_YOUR_KEY"}

r = requests.get(f"{API}/payouts", params={"broker": "quotex", "market": "otc", "min": 85}, headers=HEADERS, timeout=15)
body = r.json()
if body["ok"]:
    for pair in body["data"]:
        print(pair["name"], pair["payout"], "%")
else:
    print("Error:", body["error"]["code"], body["error"]["message"])
```

Node.js (18+):

```javascript
const API = "https://api.quantexbot.pro/v1";
const res = await fetch(`${API}/candles?broker=quotex&pair=EURUSD_otc&tf=M1&limit=5`, {
  headers: { "Authorization": "Bearer qx_live_YOUR_KEY" },
});
const body = await res.json();
if (body.ok) for (const c of body.data.candles) console.log(c.time, c.open, c.high, c.low, c.close);
else console.error(body.error.code, body.error.message);
```



## Telegram bot integration

A small Python bot that posts the best-paying open OTC pairs to your Telegram channel every 10 minutes. Make your bot an admin of the channel first.

```python
import time
import requests

QX_KEY = "qx_live_YOUR_KEY"              # Dashboard → API keys (permission: payouts:read)
BOT_TOKEN = "123456:ABC..."              # from @BotFather
CHANNEL = "@your_channel"

def best_pairs():
    r = requests.get("https://api.quantexbot.pro/v1/payouts",
                     params={"broker": "quotex", "market": "otc", "min": 85},
                     headers={"Authorization": f"Bearer {QX_KEY}"}, timeout=15)
    body = r.json()
    if not body["ok"]:
        raise RuntimeError(body["error"]["message"])
    return [p for p in body["data"] if p["open"]][:10]

while True:
    try:
        lines = [f"{p['name']} — {p['payout']}%" for p in best_pairs()]
        text = "Top OTC payouts now:\n" + "\n".join(lines) if lines else "No pair pays 85%+ right now."
        requests.post(f"https://api.telegram.org/bot{BOT_TOKEN}/sendMessage",
                      json={"chat_id": CHANNEL, "text": text}, timeout=15)
    except Exception as exc:
        print("skipped:", exc)
    time.sleep(600)
```






## Usage guide

- **Dashboard → API overview** shows your plan, limits and today's activity; **API usage** shows requests per day and per endpoint; **API logs** lists every request of the last 90 days (request bodies and keys are never stored).
- **My APIs** shows which endpoint groups your plan includes. Endpoints outside your plan answer `403 plan_upgrade_required`; upgrade in **Billing → Upgrade plan**.
- Questions? Visit the [contact](https://quantexbot.pro/contact) page; news about the API is posted on the [main channel](https://t.me/bdtraderpro).

## Market data: candles, history and live ticks

QUANTEX records the price feed of every QUOTEX, TRADOWIX and BINOLLA pair (OTC and Live) on the QUANTEX servers, around the clock. The Market Data API gives you that data directly, with **unlimited requests**:

| Plan | Price | What you get |
|---|---|---|
| Candle Basic | 15 USDT / month | Live candle data M1, M5, M15, M30, H1, H4 (`/v1/candles`, up to 2,000 candles per request) for **1 broker** of your choice, plus pairs and payouts |
| Candle Data API | 30 USDT / month | The same for **2 brokers** of your choice |
| Full Market Data API | 50 USDT / month | **All three brokers** + **historical data** (`/v1/history`, every stored day) + **live tick data** (`/v1/ticks`, `/v1/stream/ticks`) |

The brokers of Candle Basic and Candle Data API are chosen when buying; asking another broker answers `403 broker_not_in_plan`.

Live tick data exists for **QUOTEX**, **TRADOWIX** and **BINOLLA**.

### How the data is recorded

- **Ticks:** the newest price of each pair is updated several times a second. Every tick has the price, bid, ask, its exact time in milliseconds (UTC) and the broker's running M1 candle.
- **Candles:** every minute that closes is stored as an M1 candle (open, high, low, close, the payout when it opened, and whether the chart was open). M5 to H4 are built from these M1 candles, so all timeframes agree with each other.
- **History:** every day is kept on the QUANTEX servers. `/v1/history` returns every closed candle of a range of UTC days (M1: up to 7 days per request, M5 and higher: up to 31 days).

All times are UTC. `epoch` is in seconds, `epoch_ms` in milliseconds.

### Tick format

```json
{
  "symbol": "EURUSD_otc",
  "available": true,
  "price": 1.16834,
  "bid": 1.16831,
  "ask": 1.16837,
  "time": "2026-10-05T10:31:24.318Z",
  "epoch_ms": 1791196284318,
  "fresh": true,
  "candle": {"timeframe": "M1", "time": "2026-10-05T10:31:00Z", "epoch": 1791196260,
             "open": 1.16812, "high": 1.1684, "low": 1.16809, "close": 1.16834, "seconds_left": 36}
}
```

| field | meaning |
|---|---|
| `price` | last traded price shown on the broker chart |
| `bid` / `ask` | sell / buy price when the broker sends them (otherwise `null`) |
| `time`, `epoch_ms` | exact time of the tick (UTC, milliseconds) |
| `fresh` | `false` when no new tick came for 2 minutes (market closed or paused) |
| `available` | `false` when there is no tick for this pair right now |
| `candle` | the broker's running M1 candle; `close` is always the tick price. `null` when the broker sent no candle with the tick |

### Build a live chart that matches the broker

1. Load the history: `GET /v1/candles?broker=quotex&pair=EURUSD_otc&tf=M1&limit=1000` (or `/v1/history` for whole days).
2. Open the tick stream: `GET /v1/stream/ticks?broker=quotex&pairs=EURUSD_otc`.
3. On every `tick` event: when `tick.candle.epoch` equals the epoch of your last candle, replace that candle; when it is newer, the previous candle has closed, so append the new one.
4. For M5 and higher, put each M1 update into its bucket (`epoch - epoch % (minutes * 60)`), the same way the API builds them.

```js
// Browser: EventSource cannot send headers, so the key goes in the address (GET only).
// Better: run this on your own server, or limit the key to your server's IP in the dashboard.
const KEY = 'qx_live_…';
const base = 'https://api.quantexbot.pro/v1';
const pair = 'EURUSD_otc';

const res = await fetch(`${base}/candles?broker=quotex&pair=${pair}&tf=M1&limit=500`, {headers: {Authorization: `Bearer ${KEY}`}});
const candles = (await res.json()).data.candles;           // oldest first
draw(candles);

const stream = new EventSource(`${base}/stream/ticks?broker=quotex&pairs=${pair}&api_key=${KEY}`);
stream.addEventListener('tick', (e) => {
  const t = JSON.parse(e.data);
  if (!t.candle) return;
  const last = candles[candles.length - 1];
  if (last && last.epoch === t.candle.epoch) Object.assign(last, t.candle);   // same minute: update it
  else candles.push({...t.candle});                                            // new minute: the last one closed
  draw(candles);
});
// After 5 minutes the server sends "reconnect" and EventSource opens the stream again by itself.
```

```python
# Python: one day of M1 history, then the newest ticks of two pairs.
import requests
H = {"Authorization": "Bearer qx_live_…"}
day = requests.get("https://api.quantexbot.pro/v1/history", headers=H,
                   params={"broker": "quotex", "pair": "EURUSD_otc", "tf": "M1", "from": "2026-10-04"}).json()["data"]
print(day["count"], "candles")
ticks = requests.get("https://api.quantexbot.pro/v1/ticks", headers=H,
                     params={"broker": "tradowix", "pairs": "EURUSD_otc,BTCUSD_otc"}).json()["data"]["ticks"]
for t in ticks:
    print(t["symbol"], t["price"], t["time"])
```

**Unlimited** means no monthly quota and no per-minute plan limit. To keep the service fast for everyone, one account can still make at most a very high number of requests per minute (fair use); a live chart needs only the stream, which counts as one request.

## Complete examples

Whole programs, tested against the API, in Python, Node.js and PHP. Put the key in the environment variable QX_API_KEY (or in the file where it says so) and run them.

### Live candle chart on your website

A page with a moving candle chart (M1 to H4) and a pair list, fed by candles and live ticks. A small server file adds your key, so visitors never see it, and shares one answer between all visitors.

Endpoint groups: Brokers & pairs, Candles (OHLC), Live ticks. Result: A live chart that moves with every tick, like the broker’s. Choose the pair and the timeframe at the top.

#### PHP — Copy index.html and api.php into a folder of your website (XAMPP: C:\xampp\htdocs\chart). Open api.php and write your key in the line with qx_live_PUT_YOUR_KEY_HERE. Then open http://localhost/chart/index.html (or your domain).

`index.html`:

```html
<!doctype html>
<!--
  QUANTEX API - live candle chart for your own website

  The page asks YOUR server (api.php, server.js or server.py in this folder) for data.
  Your server adds the API key, so the key is never visible in the browser.
  Chart library: TradingView Lightweight Charts (free, keep its attribution).
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Live chart</title>
<script src="https://unpkg.com/lightweight-charts@5.0.9/dist/lightweight-charts.standalone.production.js"></script>
<style>
  :root { color-scheme: dark; --bg: #0b1020; --panel: #121933; --line: #222b4d; --text: #e6e9f5; --muted: #8a93b5; --up: #22c55e; --down: #ef4444; --accent: #3b82f6; }
  * { box-sizing: border-box; }
  body { margin: 0; font: 14px/1.4 system-ui, sans-serif; background: var(--bg); color: var(--text); }
  .bar { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; padding: 10px 14px; background: var(--panel); border-bottom: 1px solid var(--line); }
  select, button { font: inherit; color: var(--text); background: var(--bg); border: 1px solid var(--line); border-radius: 8px; padding: 6px 10px; cursor: pointer; }
  button[aria-pressed="true"] { background: var(--accent); border-color: var(--accent); color: #fff; }
  .price { margin-left: auto; font-weight: 700; font-size: 18px; font-variant-numeric: tabular-nums; }
  .price.up { color: var(--up); } .price.down { color: var(--down); }
  .status { color: var(--muted); font-size: 12px; }
  #chart { height: calc(100vh - 56px); min-height: 360px; }
</style>
</head>
<body>
<div class="bar">
  <select id="pair" aria-label="Pair"></select>
  <span id="tfs"></span>
  <span class="status" id="status">loading…</span>
  <span class="price" id="price">–</span>
</div>
<div id="chart"></div>

<script>
const API = "api.php";                       // the same address works with api.php, server.js and server.py
const TF_SECONDS = { M1: 60, M5: 300, M15: 900, M30: 1800, H1: 3600, H4: 14400 };
let pair = new URLSearchParams(location.search).get("pair") || "EURUSD_otc";
let tf = "M1";
let bars = [];
let session = 0;                             // changes when the pair or timeframe changes

const $ = (id) => document.getElementById(id);
const chart = LightweightCharts.createChart($("chart"), {
  autoSize: true,
  localization: { locale: navigator.language && !navigator.language.includes("@") ? navigator.language : "en-US" },
  layout: { background: { color: "#0b1020" }, textColor: "#8a93b5" },
  grid: { vertLines: { color: "#161e3b" }, horzLines: { color: "#161e3b" } },
  timeScale: { timeVisible: true, secondsVisible: false },
});
const series = chart.addSeries(LightweightCharts.CandlestickSeries, {
  upColor: "#22c55e", downColor: "#ef4444", borderVisible: false, wickUpColor: "#22c55e", wickDownColor: "#ef4444",
});

async function get(query) {
  const res = await fetch(`${API}?${new URLSearchParams(query)}`);
  const body = await res.json();
  if (!body.ok) throw new Error(body.error);
  return body.data;
}

/** Candles from the server: [[epoch, open, high, low, close], ...], oldest first. */
const toBars = (rows) => rows.map(([time, open, high, low, close]) => ({ time, open, high, low, close }));

async function load() {
  const my = ++session;
  $("status").textContent = "loading…";
  bars = toBars(await get({ do: "candles", pair, tf, limit: 500 }));
  // M5 and higher: the API sends closed candles only, so build the running one from M1 candles.
  if (tf !== "M1" && bars.length) {
    const sec = TF_SECONDS[tf];
    const start = Math.floor(Date.now() / 1000 / sec) * sec;
    const m1 = toBars(await get({ do: "candles", pair, tf: "M1", limit: sec / 60 })).filter((b) => b.time >= start);
    if (m1.length) {
      bars.push({ time: start, open: m1[0].open, close: m1[m1.length - 1].close,
        high: Math.max(...m1.map((b) => b.high)), low: Math.min(...m1.map((b) => b.low)) });
    }
  }
  if (my !== session) return;
  // Show as many decimals as the pair has (EUR/USD 5, BTC/USD 2 ...).
  const dec = Math.min(6, Math.max(2, ...bars.slice(-50).map((b) => (String(b.close).split(".")[1] || "").length)));
  series.applyOptions({ priceFormat: { type: "price", precision: dec, minMove: 1 / 10 ** dec } });
  series.setData(bars);
  chart.timeScale().scrollToRealTime();
  $("status").textContent = `${pair} · ${tf}`;
}

/** One live tick: update the last candle, or start a new one when its period begins. */
function applyTick(t) {
  const sec = TF_SECONDS[tf];
  const now = Math.floor(t.epoch_ms / 1000);
  const bucket = now - (now % sec);
  let last = bars[bars.length - 1];
  if (last && bucket < last.time) return;
  if (!last || bucket > last.time) {
    const open = t.candle && t.candle.epoch === bucket ? t.candle.open : last ? last.close : t.price;
    last = { time: bucket, open, high: Math.max(open, t.price), low: Math.min(open, t.price), close: t.price };
    bars.push(last);
  } else {
    last.high = Math.max(last.high, t.price);
    last.low = Math.min(last.low, t.price);
    last.close = t.price;
  }
  if (tf === "M1" && t.candle && t.candle.epoch === bucket) {   // M1: the broker's own candle is exact
    Object.assign(last, { open: t.candle.open, high: t.candle.high, low: t.candle.low, close: t.candle.close });
  }
  series.update({ ...last });
  const el = $("price");
  el.className = "price " + (last.close >= last.open ? "up" : "down");
  el.textContent = t.price;
}

async function poll() {
  const my = session;
  try {
    const t = await get({ do: "tick", pair });
    if (my === session && t.available) applyTick(t);
  } catch (e) {
    $("status").textContent = "reconnecting…";
  }
  setTimeout(poll, 500);                     // two updates a second; your server shares them between all visitors
}

async function start() {
  const pairs = await get({ do: "pairs" });
  $("pair").innerHTML = pairs.map((p) => `<option value="${p.symbol}">${p.name} · ${p.payout}%</option>`).join("");
  if (!pairs.some((p) => p.symbol === pair) && pairs.length) pair = pairs[0].symbol;
  $("pair").value = pair;
  $("pair").onchange = () => { pair = $("pair").value; load(); };

  $("tfs").innerHTML = Object.keys(TF_SECONDS).map((x) => `<button type="button" data-tf="${x}">${x}</button>`).join(" ");
  const mark = () => document.querySelectorAll("[data-tf]").forEach((b) => b.setAttribute("aria-pressed", String(b.dataset.tf === tf)));
  $("tfs").onclick = (e) => { if (e.target.dataset.tf) { tf = e.target.dataset.tf; mark(); load(); } };
  mark();

  await load();
  poll();
}
start().catch((e) => { $("status").textContent = "Error: " + e.message; });
</script>
</body>
</html>
```

`api.php`:

```php
<?php
/*
 * QUANTEX API - data for index.html (PHP 8.0+, curl extension)
 *
 * Put index.html and this file in one folder of your website (XAMPP: htdocs/chart).
 * Write your key below (or set QX_API_KEY). The browser never sees the key.
 *   api.php?do=pairs                       open pairs with payout
 *   api.php?do=candles&pair=..&tf=M1       candles [[epoch, open, high, low, close], ...]
 *   api.php?do=tick&pair=..                newest live tick
 * Answers are cached for a moment, so 1 or 1000 visitors make the same few API requests.
 */
const QX_API = 'https://api.quantexbot.pro/v1';
const BROKER = 'quotex';                                   // quotex or tradowix (live ticks)
$key = getenv('QX_API_KEY') ?: 'qx_live_PUT_YOUR_KEY_HERE';
$api = getenv('QX_API') ?: QX_API;

header('Content-Type: application/json');
header('Cache-Control: no-store');

function answer(bool $ok, $data): void
{
    echo json_encode($ok ? ['ok' => true, 'data' => $data] : ['ok' => false, 'error' => $data]);
    exit;
}

/** GET from the QUANTEX API, with a small file cache shared by all visitors. */
function quantex(string $path, array $query, float $cacheSeconds)
{
    global $key, $api;
    $file = sys_get_temp_dir().'/qx-'.md5($path.'?'.http_build_query($query)).'.json';
    $cached = is_file($file) ? json_decode((string) file_get_contents($file), true) : null;
    if ($cached && microtime(true) - $cached['t'] < $cacheSeconds) {
        return $cached['d'];
    }
    $ch = curl_init($api.$path.'?'.http_build_query($query));
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15, CURLOPT_HTTPHEADER => ["Authorization: Bearer $key"]]);
    $body = json_decode((string) curl_exec($ch), true);
    curl_close($ch);
    if (empty($body['ok'])) {
        answer(false, $body['error']['message'] ?? 'QUANTEX API not reachable');
    }
    file_put_contents($file, json_encode(['t' => microtime(true), 'd' => $body['data']]), LOCK_EX);

    return $body['data'];
}

// Only accept what the page needs: nobody can use your key for anything else.
$pair = preg_match('/^[A-Za-z0-9_]{3,30}$/', $_GET['pair'] ?? '') ? $_GET['pair'] : null;
$tf = in_array($_GET['tf'] ?? 'M1', ['M1', 'M5', 'M15', 'M30', 'H1', 'H4'], true) ? ($_GET['tf'] ?? 'M1') : 'M1';
$limit = max(1, min(1000, (int) ($_GET['limit'] ?? 500)));

switch ($_GET['do'] ?? '') {
    case 'pairs':
        $pairs = quantex('/pairs', ['broker' => BROKER, 'open' => 'true'], 60);
        usort($pairs, fn ($a, $b) => ($b['payout'] ?? 0) <=> ($a['payout'] ?? 0));
        answer(true, array_map(fn ($p) => ['symbol' => $p['symbol'], 'name' => $p['name'], 'payout' => $p['payout']], $pairs));

    case 'candles':
        $pair || answer(false, 'pair missing');
        $data = quantex('/candles', ['broker' => BROKER, 'pair' => $pair, 'tf' => $tf, 'limit' => $limit], 5);
        answer(true, array_map(fn ($c) => [$c['epoch'], $c['open'], $c['high'], $c['low'], $c['close']], $data['candles']));

    case 'tick':
        $pair || answer(false, 'pair missing');
        answer(true, quantex('/ticks', ['broker' => BROKER, 'pairs' => $pair], 0.4)['ticks'][0]);
}
answer(false, 'unknown request');
```

#### Node.js — set `QX_API_KEY` · run: `node server.js`

`index.html`:

```html
<!doctype html>
<!--
  QUANTEX API - live candle chart for your own website

  The page asks YOUR server (api.php, server.js or server.py in this folder) for data.
  Your server adds the API key, so the key is never visible in the browser.
  Chart library: TradingView Lightweight Charts (free, keep its attribution).
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Live chart</title>
<script src="https://unpkg.com/lightweight-charts@5.0.9/dist/lightweight-charts.standalone.production.js"></script>
<style>
  :root { color-scheme: dark; --bg: #0b1020; --panel: #121933; --line: #222b4d; --text: #e6e9f5; --muted: #8a93b5; --up: #22c55e; --down: #ef4444; --accent: #3b82f6; }
  * { box-sizing: border-box; }
  body { margin: 0; font: 14px/1.4 system-ui, sans-serif; background: var(--bg); color: var(--text); }
  .bar { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; padding: 10px 14px; background: var(--panel); border-bottom: 1px solid var(--line); }
  select, button { font: inherit; color: var(--text); background: var(--bg); border: 1px solid var(--line); border-radius: 8px; padding: 6px 10px; cursor: pointer; }
  button[aria-pressed="true"] { background: var(--accent); border-color: var(--accent); color: #fff; }
  .price { margin-left: auto; font-weight: 700; font-size: 18px; font-variant-numeric: tabular-nums; }
  .price.up { color: var(--up); } .price.down { color: var(--down); }
  .status { color: var(--muted); font-size: 12px; }
  #chart { height: calc(100vh - 56px); min-height: 360px; }
</style>
</head>
<body>
<div class="bar">
  <select id="pair" aria-label="Pair"></select>
  <span id="tfs"></span>
  <span class="status" id="status">loading…</span>
  <span class="price" id="price">–</span>
</div>
<div id="chart"></div>

<script>
const API = "api.php";                       // the same address works with api.php, server.js and server.py
const TF_SECONDS = { M1: 60, M5: 300, M15: 900, M30: 1800, H1: 3600, H4: 14400 };
let pair = new URLSearchParams(location.search).get("pair") || "EURUSD_otc";
let tf = "M1";
let bars = [];
let session = 0;                             // changes when the pair or timeframe changes

const $ = (id) => document.getElementById(id);
const chart = LightweightCharts.createChart($("chart"), {
  autoSize: true,
  localization: { locale: navigator.language && !navigator.language.includes("@") ? navigator.language : "en-US" },
  layout: { background: { color: "#0b1020" }, textColor: "#8a93b5" },
  grid: { vertLines: { color: "#161e3b" }, horzLines: { color: "#161e3b" } },
  timeScale: { timeVisible: true, secondsVisible: false },
});
const series = chart.addSeries(LightweightCharts.CandlestickSeries, {
  upColor: "#22c55e", downColor: "#ef4444", borderVisible: false, wickUpColor: "#22c55e", wickDownColor: "#ef4444",
});

async function get(query) {
  const res = await fetch(`${API}?${new URLSearchParams(query)}`);
  const body = await res.json();
  if (!body.ok) throw new Error(body.error);
  return body.data;
}

/** Candles from the server: [[epoch, open, high, low, close], ...], oldest first. */
const toBars = (rows) => rows.map(([time, open, high, low, close]) => ({ time, open, high, low, close }));

async function load() {
  const my = ++session;
  $("status").textContent = "loading…";
  bars = toBars(await get({ do: "candles", pair, tf, limit: 500 }));
  // M5 and higher: the API sends closed candles only, so build the running one from M1 candles.
  if (tf !== "M1" && bars.length) {
    const sec = TF_SECONDS[tf];
    const start = Math.floor(Date.now() / 1000 / sec) * sec;
    const m1 = toBars(await get({ do: "candles", pair, tf: "M1", limit: sec / 60 })).filter((b) => b.time >= start);
    if (m1.length) {
      bars.push({ time: start, open: m1[0].open, close: m1[m1.length - 1].close,
        high: Math.max(...m1.map((b) => b.high)), low: Math.min(...m1.map((b) => b.low)) });
    }
  }
  if (my !== session) return;
  // Show as many decimals as the pair has (EUR/USD 5, BTC/USD 2 ...).
  const dec = Math.min(6, Math.max(2, ...bars.slice(-50).map((b) => (String(b.close).split(".")[1] || "").length)));
  series.applyOptions({ priceFormat: { type: "price", precision: dec, minMove: 1 / 10 ** dec } });
  series.setData(bars);
  chart.timeScale().scrollToRealTime();
  $("status").textContent = `${pair} · ${tf}`;
}

/** One live tick: update the last candle, or start a new one when its period begins. */
function applyTick(t) {
  const sec = TF_SECONDS[tf];
  const now = Math.floor(t.epoch_ms / 1000);
  const bucket = now - (now % sec);
  let last = bars[bars.length - 1];
  if (last && bucket < last.time) return;
  if (!last || bucket > last.time) {
    const open = t.candle && t.candle.epoch === bucket ? t.candle.open : last ? last.close : t.price;
    last = { time: bucket, open, high: Math.max(open, t.price), low: Math.min(open, t.price), close: t.price };
    bars.push(last);
  } else {
    last.high = Math.max(last.high, t.price);
    last.low = Math.min(last.low, t.price);
    last.close = t.price;
  }
  if (tf === "M1" && t.candle && t.candle.epoch === bucket) {   // M1: the broker's own candle is exact
    Object.assign(last, { open: t.candle.open, high: t.candle.high, low: t.candle.low, close: t.candle.close });
  }
  series.update({ ...last });
  const el = $("price");
  el.className = "price " + (last.close >= last.open ? "up" : "down");
  el.textContent = t.price;
}

async function poll() {
  const my = session;
  try {
    const t = await get({ do: "tick", pair });
    if (my === session && t.available) applyTick(t);
  } catch (e) {
    $("status").textContent = "reconnecting…";
  }
  setTimeout(poll, 500);                     // two updates a second; your server shares them between all visitors
}

async function start() {
  const pairs = await get({ do: "pairs" });
  $("pair").innerHTML = pairs.map((p) => `<option value="${p.symbol}">${p.name} · ${p.payout}%</option>`).join("");
  if (!pairs.some((p) => p.symbol === pair) && pairs.length) pair = pairs[0].symbol;
  $("pair").value = pair;
  $("pair").onchange = () => { pair = $("pair").value; load(); };

  $("tfs").innerHTML = Object.keys(TF_SECONDS).map((x) => `<button type="button" data-tf="${x}">${x}</button>`).join(" ");
  const mark = () => document.querySelectorAll("[data-tf]").forEach((b) => b.setAttribute("aria-pressed", String(b.dataset.tf === tf)));
  $("tfs").onclick = (e) => { if (e.target.dataset.tf) { tf = e.target.dataset.tf; mark(); load(); } };
  mark();

  await load();
  poll();
}
start().catch((e) => { $("status").textContent = "Error: " + e.message; });
</script>
</body>
</html>
```

`server.js`:

```javascript
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
```

#### Python — install: `pip install flask requests` · set `QX_API_KEY` · run: `python server.py`

`index.html`:

```html
<!doctype html>
<!--
  QUANTEX API - live candle chart for your own website

  The page asks YOUR server (api.php, server.js or server.py in this folder) for data.
  Your server adds the API key, so the key is never visible in the browser.
  Chart library: TradingView Lightweight Charts (free, keep its attribution).
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Live chart</title>
<script src="https://unpkg.com/lightweight-charts@5.0.9/dist/lightweight-charts.standalone.production.js"></script>
<style>
  :root { color-scheme: dark; --bg: #0b1020; --panel: #121933; --line: #222b4d; --text: #e6e9f5; --muted: #8a93b5; --up: #22c55e; --down: #ef4444; --accent: #3b82f6; }
  * { box-sizing: border-box; }
  body { margin: 0; font: 14px/1.4 system-ui, sans-serif; background: var(--bg); color: var(--text); }
  .bar { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; padding: 10px 14px; background: var(--panel); border-bottom: 1px solid var(--line); }
  select, button { font: inherit; color: var(--text); background: var(--bg); border: 1px solid var(--line); border-radius: 8px; padding: 6px 10px; cursor: pointer; }
  button[aria-pressed="true"] { background: var(--accent); border-color: var(--accent); color: #fff; }
  .price { margin-left: auto; font-weight: 700; font-size: 18px; font-variant-numeric: tabular-nums; }
  .price.up { color: var(--up); } .price.down { color: var(--down); }
  .status { color: var(--muted); font-size: 12px; }
  #chart { height: calc(100vh - 56px); min-height: 360px; }
</style>
</head>
<body>
<div class="bar">
  <select id="pair" aria-label="Pair"></select>
  <span id="tfs"></span>
  <span class="status" id="status">loading…</span>
  <span class="price" id="price">–</span>
</div>
<div id="chart"></div>

<script>
const API = "api.php";                       // the same address works with api.php, server.js and server.py
const TF_SECONDS = { M1: 60, M5: 300, M15: 900, M30: 1800, H1: 3600, H4: 14400 };
let pair = new URLSearchParams(location.search).get("pair") || "EURUSD_otc";
let tf = "M1";
let bars = [];
let session = 0;                             // changes when the pair or timeframe changes

const $ = (id) => document.getElementById(id);
const chart = LightweightCharts.createChart($("chart"), {
  autoSize: true,
  localization: { locale: navigator.language && !navigator.language.includes("@") ? navigator.language : "en-US" },
  layout: { background: { color: "#0b1020" }, textColor: "#8a93b5" },
  grid: { vertLines: { color: "#161e3b" }, horzLines: { color: "#161e3b" } },
  timeScale: { timeVisible: true, secondsVisible: false },
});
const series = chart.addSeries(LightweightCharts.CandlestickSeries, {
  upColor: "#22c55e", downColor: "#ef4444", borderVisible: false, wickUpColor: "#22c55e", wickDownColor: "#ef4444",
});

async function get(query) {
  const res = await fetch(`${API}?${new URLSearchParams(query)}`);
  const body = await res.json();
  if (!body.ok) throw new Error(body.error);
  return body.data;
}

/** Candles from the server: [[epoch, open, high, low, close], ...], oldest first. */
const toBars = (rows) => rows.map(([time, open, high, low, close]) => ({ time, open, high, low, close }));

async function load() {
  const my = ++session;
  $("status").textContent = "loading…";
  bars = toBars(await get({ do: "candles", pair, tf, limit: 500 }));
  // M5 and higher: the API sends closed candles only, so build the running one from M1 candles.
  if (tf !== "M1" && bars.length) {
    const sec = TF_SECONDS[tf];
    const start = Math.floor(Date.now() / 1000 / sec) * sec;
    const m1 = toBars(await get({ do: "candles", pair, tf: "M1", limit: sec / 60 })).filter((b) => b.time >= start);
    if (m1.length) {
      bars.push({ time: start, open: m1[0].open, close: m1[m1.length - 1].close,
        high: Math.max(...m1.map((b) => b.high)), low: Math.min(...m1.map((b) => b.low)) });
    }
  }
  if (my !== session) return;
  // Show as many decimals as the pair has (EUR/USD 5, BTC/USD 2 ...).
  const dec = Math.min(6, Math.max(2, ...bars.slice(-50).map((b) => (String(b.close).split(".")[1] || "").length)));
  series.applyOptions({ priceFormat: { type: "price", precision: dec, minMove: 1 / 10 ** dec } });
  series.setData(bars);
  chart.timeScale().scrollToRealTime();
  $("status").textContent = `${pair} · ${tf}`;
}

/** One live tick: update the last candle, or start a new one when its period begins. */
function applyTick(t) {
  const sec = TF_SECONDS[tf];
  const now = Math.floor(t.epoch_ms / 1000);
  const bucket = now - (now % sec);
  let last = bars[bars.length - 1];
  if (last && bucket < last.time) return;
  if (!last || bucket > last.time) {
    const open = t.candle && t.candle.epoch === bucket ? t.candle.open : last ? last.close : t.price;
    last = { time: bucket, open, high: Math.max(open, t.price), low: Math.min(open, t.price), close: t.price };
    bars.push(last);
  } else {
    last.high = Math.max(last.high, t.price);
    last.low = Math.min(last.low, t.price);
    last.close = t.price;
  }
  if (tf === "M1" && t.candle && t.candle.epoch === bucket) {   // M1: the broker's own candle is exact
    Object.assign(last, { open: t.candle.open, high: t.candle.high, low: t.candle.low, close: t.candle.close });
  }
  series.update({ ...last });
  const el = $("price");
  el.className = "price " + (last.close >= last.open ? "up" : "down");
  el.textContent = t.price;
}

async function poll() {
  const my = session;
  try {
    const t = await get({ do: "tick", pair });
    if (my === session && t.available) applyTick(t);
  } catch (e) {
    $("status").textContent = "reconnecting…";
  }
  setTimeout(poll, 500);                     // two updates a second; your server shares them between all visitors
}

async function start() {
  const pairs = await get({ do: "pairs" });
  $("pair").innerHTML = pairs.map((p) => `<option value="${p.symbol}">${p.name} · ${p.payout}%</option>`).join("");
  if (!pairs.some((p) => p.symbol === pair) && pairs.length) pair = pairs[0].symbol;
  $("pair").value = pair;
  $("pair").onchange = () => { pair = $("pair").value; load(); };

  $("tfs").innerHTML = Object.keys(TF_SECONDS).map((x) => `<button type="button" data-tf="${x}">${x}</button>`).join(" ");
  const mark = () => document.querySelectorAll("[data-tf]").forEach((b) => b.setAttribute("aria-pressed", String(b.dataset.tf === tf)));
  $("tfs").onclick = (e) => { if (e.target.dataset.tf) { tf = e.target.dataset.tf; mark(); load(); } };
  mark();

  await load();
  poll();
}
start().catch((e) => { $("status").textContent = "Error: " + e.message; });
</script>
</body>
</html>
```

`server.py`:

```python
"""
QUANTEX API - server for index.html (Python 3.8+, Flask)

Serves index.html and the data it needs. Your key stays on the server.
Answers are cached for a moment, so 1 or 1000 visitors make the same few API requests.

Run
  pip install flask requests
  export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
  python server.py                     then open http://localhost:8000
"""
import os
import re
import threading
import time

import requests
from flask import Flask, jsonify, request, send_from_directory

QX_API = os.environ.get("QX_API", "https://api.quantexbot.pro/v1")
BROKER = os.environ.get("QX_BROKER", "quotex")              # quotex or tradowix (live ticks)
http = requests.Session()
http.headers["Authorization"] = f"Bearer {os.environ['QX_API_KEY']}"
app = Flask(__name__)
cache, lock = {}, threading.Lock()


class ApiError(Exception):
    pass


def quantex(path, params, cache_seconds):
    """GET from the QUANTEX API, cached and shared by all visitors."""
    key = path + repr(sorted(params.items()))
    with lock:
        hit = cache.get(key)
        if hit and time.time() - hit[0] < cache_seconds:
            return hit[1]
    body = http.get(QX_API + path, params=params, timeout=15).json()
    if not body.get("ok"):
        raise ApiError(body["error"]["message"])
    with lock:
        cache[key] = (time.time(), body["data"])
    return body["data"]


@app.get("/")
def index():
    return send_from_directory(os.path.dirname(os.path.abspath(__file__)), "index.html")


@app.get("/api.php")                                      # same address as the PHP version
def api():
    # Only accept what the page needs: nobody can use your key for anything else.
    pair = request.args.get("pair", "")
    pair = pair if re.fullmatch(r"[A-Za-z0-9_]{3,30}", pair) else None
    tf = request.args.get("tf", "M1")
    tf = tf if tf in ("M1", "M5", "M15", "M30", "H1", "H4") else "M1"
    limit = max(1, min(1000, int(request.args.get("limit", "500") or 500)))
    try:
        what = request.args.get("do")
        if what == "pairs":
            pairs = sorted(quantex("/pairs", {"broker": BROKER, "open": "true"}, 60), key=lambda p: -(p["payout"] or 0))
            return jsonify(ok=True, data=[{"symbol": p["symbol"], "name": p["name"], "payout": p["payout"]} for p in pairs])
        if what in ("candles", "tick") and not pair:
            raise ApiError("pair missing")
        if what == "candles":
            data = quantex("/candles", {"broker": BROKER, "pair": pair, "tf": tf, "limit": limit}, 5)
            return jsonify(ok=True, data=[[c["epoch"], c["open"], c["high"], c["low"], c["close"]] for c in data["candles"]])
        if what == "tick":
            return jsonify(ok=True, data=quantex("/ticks", {"broker": BROKER, "pairs": pair}, 0.4)["ticks"][0])
        raise ApiError("unknown request")
    except (ApiError, requests.RequestException) as e:
        return jsonify(ok=False, error=str(e))


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=int(os.environ.get("PORT", "8000")), threaded=True)
```

### Download historical candles to CSV

Downloads every closed candle of a date range for one pair and saves it as CSV, for Excel, backtests or your own database. Long ranges are fetched in parts automatically.

Endpoint groups: Historical candles. Result: A file like EURUSD_otc_M1_2026-09-01_2026-09-30.csv with time, open, high, low, close, payout and volume.

#### Python — install: `pip install requests` · set `QX_API_KEY` · run: `python export.py EURUSD_otc M1 2026-09-01 2026-09-30`

`export.py`:

```python
"""
QUANTEX API - download historical candles to a CSV file (Python 3.8+)

GET /v1/history gives every closed candle of whole UTC days. M1 allows 7 days
per request, M5 and higher 31 days, so a long range is fetched in parts.

Run
  pip install requests
  export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
  python export.py EURUSD_otc M1 2026-09-01 2026-09-30
  -> EURUSD_otc_M1_2026-09-01_2026-09-30.csv
"""
import csv
import os
import sys
import time
from datetime import date, timedelta

import requests

QX_API = os.environ.get("QX_API", "https://api.quantexbot.pro/v1")
KEY = os.environ["QX_API_KEY"]
BROKER = os.environ.get("QX_BROKER", "quotex")

if len(sys.argv) < 5:
    sys.exit("Use: python export.py PAIR TIMEFRAME FROM TO   e.g. EURUSD_otc M1 2026-09-01 2026-09-30")
pair, tf, first, last = sys.argv[1], sys.argv[2].upper(), date.fromisoformat(sys.argv[3]), date.fromisoformat(sys.argv[4])
step = 7 if tf == "M1" else 31                              # days per request

http = requests.Session()
http.headers["Authorization"] = f"Bearer {KEY}"
out = f"{pair}_{tf}_{first}_{last}.csv"

with open(out, "w", newline="") as f:
    w = csv.writer(f)
    w.writerow(["time_utc", "epoch", "open", "high", "low", "close", "payout", "volume"])
    day, total = first, 0
    while day <= last:
        to = min(day + timedelta(days=step - 1), last)
        r = http.get(f"{QX_API}/history", timeout=120,
                     params={"broker": BROKER, "pair": pair, "tf": tf, "from": day.isoformat(), "to": to.isoformat()})
        if r.status_code == 429:                            # too many requests: wait and ask again
            time.sleep(int(r.headers.get("Retry-After", "5")))
            continue
        answer = r.json()
        if not answer["ok"]:
            sys.exit(f"Error {answer['error']['code']}: {answer['error']['message']}")
        for c in answer["data"]["candles"]:
            w.writerow([c["time"], c["epoch"], c["open"], c["high"], c["low"], c["close"], c["payout"], c["volume"]])
        total += answer["data"]["count"]
        print(f"{day} .. {to}: {answer['data']['count']} candles")
        day = to + timedelta(days=1)

print(f"Saved {total} candles to {out}")
```

#### Node.js — set `QX_API_KEY` · run: `node export.js EURUSD_otc M1 2026-09-01 2026-09-30`

`export.js`:

```javascript
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
```

#### PHP — set `QX_API_KEY` · run: `php export.php EURUSD_otc M1 2026-09-01 2026-09-30`

`export.php`:

```php
<?php
/*
 * QUANTEX API - download historical candles to a CSV file (PHP 8.0+, curl extension)
 *
 * GET /v1/history gives every closed candle of whole UTC days. M1 allows 7 days
 * per request, M5 and higher 31 days, so a long range is fetched in parts.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   php export.php EURUSD_otc M1 2026-09-01 2026-09-30
 *   -> EURUSD_otc_M1_2026-09-01_2026-09-30.csv
 */
$api = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$key = getenv('QX_API_KEY');
$broker = getenv('QX_BROKER') ?: 'quotex';
if ($argc < 5) {
    exit("Use: php export.php PAIR TIMEFRAME FROM TO   e.g. EURUSD_otc M1 2026-09-01 2026-09-30\n");
}
[, $pair, $tf, $first, $last] = $argv;
$tf = strtoupper($tf);
$step = $tf === 'M1' ? 7 : 31;                    // days per request

$out = "{$pair}_{$tf}_{$first}_{$last}.csv";
$file = fopen($out, 'w');
fputcsv($file, ['time_utc', 'epoch', 'open', 'high', 'low', 'close', 'payout', 'volume']);
$day = new DateTimeImmutable($first, new DateTimeZone('UTC'));
$end = new DateTimeImmutable($last, new DateTimeZone('UTC'));
$total = 0;
while ($day <= $end) {
    $to = min($day->modify('+'.($step - 1).' days'), $end);
    $query = http_build_query(['broker' => $broker, 'pair' => $pair, 'tf' => $tf, 'from' => $day->format('Y-m-d'), 'to' => $to->format('Y-m-d')]);
    $ch = curl_init("$api/history?$query");
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 120, CURLOPT_HTTPHEADER => ["Authorization: Bearer $key"]]);
    $answer = json_decode((string) curl_exec($ch), true);
    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    if ($status === 429) {                          // too many requests: wait and ask again
        sleep(5);
        continue;
    }
    if (empty($answer['ok'])) {
        exit('Error '.($answer['error']['code'] ?? 'network').': '.($answer['error']['message'] ?? 'no answer')."\n");
    }
    foreach ($answer['data']['candles'] as $c) {
        fputcsv($file, [$c['time'], $c['epoch'], $c['open'], $c['high'], $c['low'], $c['close'], $c['payout'], $c['volume']]);
    }
    $total += $answer['data']['count'];
    echo $day->format('Y-m-d'), ' .. ', $to->format('Y-m-d'), ": {$answer['data']['count']} candles\n";
    $day = $to->modify('+1 day');
}
fclose($file);
echo "Saved $total candles to $out\n";
```

## Endpoint reference

Every answer is JSON: `{"ok": true, "data": …, "meta": {"request_id": "req_…"}}` or `{"ok": false, "error": {"code", "message"}, "meta": {…}}`. Send the key as `Authorization: Bearer qx_live_…` (or `?api_key=` on GET, for quick tests in a browser).

### `GET /v1/status`

Status of the API, data feeds, Telegram bot and payments, and open incidents (the same as quantexbot.pro/status). status: operational, degraded, partial_outage, major_outage or maintenance; each component: operational, degraded, down or unknown. No key needed.

- No API key needed.

Example `data`:

```json
{
    "status": "operational",
    "api_version": "v1",
    "server_time": "2026-10-05T10:00:00Z",
    "components": {
        "api": "operational",
        "market_data": "operational",
        "website": "operational",
        "telegram_bot": "operational",
        "payments": "operational"
    },
    "incidents": [],
    "page": "https://quantexbot.pro/status"
}
```

### `GET /v1/account`

Your plan, its limits, what you used and the key in use.

- Key permission (scope): `account:read` · endpoint group: `account` · plans: —

Example `data`:

```json
{
    "plan": {
        "key": "market_data",
        "name": "Market Data",
        "expires_at": "2026-11-04T10:00:00Z"
    },
    "limits": {
        "requests_per_minute": 60,
        "requests_per_month": 100000,
        "api_keys": 2
    },
    "usage": {
        "month": 1520,
        "month_remaining": 98480,
        "resets_at": "2026-11-01T00:00:00Z"
    },
    "groups": [
        "markets",
        "payouts",
        "account",
        "candles",
        "history",
        "ticks"
    ],
    "key": {
        "name": "My bot",
        "prefix": "Ab12Cd34",
        "scopes": [
            "markets:read",
            "candles:read"
        ]
    }
}
```

### `GET /v1/usage`

Requests per day and per endpoint.

- Key permission (scope): `account:read` · endpoint group: `account` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `days` | query | integer | no | Number of days, 1-90. Default: 30. |

Example `data`:

```json
{
    "days": [
        {
            "date": "2026-10-05",
            "requests": 320,
            "errors": 2
        }
    ],
    "endpoints": [
        {
            "endpoint": "pairs",
            "requests": 210,
            "errors": 0
        }
    ]
}
```

### `GET /v1/brokers`

Supported brokers and whether their data feed is live.

- Key permission (scope): `markets:read` · endpoint group: `markets` · plans: —

Example `data`:

```json
[
    {
        "id": "quotex",
        "name": "QUOTEX",
        "status": "operational",
        "pairs": 92,
        "open_pairs": 61,
        "markets": [
            "live",
            "otc"
        ],
        "updated_at": "2026-10-05T10:00:00Z"
    }
]
```

### `GET /v1/pairs`

Pairs of a broker: OTC or Live, category, open now, current payout.

- Key permission (scope): `markets:read` · endpoint group: `markets` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla (the ones your plan covers: Candle Basic 1, Candle Data 2, Full Market Data all 3; otherwise error broker_not_in_plan). One of: quotex, tradowix, binolla. Default: quotex. |
| `market` | query | string | no | otc, live or all. One of: all, otc, live. Default: all. |
| `open` | query | boolean | no | true = only pairs that are open now. Default: false. |

Example `data`:

```json
[
    {
        "symbol": "EURUSD_otc",
        "name": "EUR/USD (OTC)",
        "market": "otc",
        "category": "currency",
        "open": true,
        "payout": 87,
        "updated_at": "2026-10-05T10:00:00Z"
    }
]
```

### `GET /v1/payouts`

Current payout % of every pair, highest first.

- Key permission (scope): `payouts:read` · endpoint group: `payouts` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla (the ones your plan covers: Candle Basic 1, Candle Data 2, Full Market Data all 3; otherwise error broker_not_in_plan). One of: quotex, tradowix, binolla. Default: quotex. |
| `market` | query | string | no | otc, live or all. One of: all, otc, live. Default: all. |
| `min` | query | integer | no | Only pairs paying at least this % (0-100). Default: 0. |

Example `data`:

```json
[
    {
        "symbol": "BTCUSD_otc",
        "name": "BTC/USD (OTC)",
        "market": "otc",
        "payout": 92,
        "open": true,
        "updated_at": "2026-10-05T10:00:00Z"
    }
]
```

### `GET /v1/candles`

OHLC candles (UTC), oldest first. M1 gives every stored minute (only closed minutes are stored). M5 and higher give only closed candles: the running candle is left out until its period has ended (at 12:23 the newest M5 candle is the one of 12:15; 12:20 arrives complete after 12:25). Without date: the most recent candles; with date: that UTC day (within your plan's history). Brokers give no real volume, so volume is an activity score: the candle's range (60 %) and body (40 %) against the average of the 20 candles before it, x100 (100 = normal, 0 when fewer than 20 earlier candles). payout = the broker's payout % when the candle opened.

- Key permission (scope): `candles:read` · endpoint group: `candles` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla (the ones your plan covers: Candle Basic 1, Candle Data 2, Full Market Data all 3; otherwise error broker_not_in_plan). One of: quotex, tradowix, binolla. Default: quotex. |
| `pair` | query | string | yes | Pair symbol from /v1/pairs, e.g. EURUSD_otc. |
| `tf` | query | string | no | Timeframe. One of: M1, M5, M15, M30, H1, H4. Default: M1. |
| `limit` | query | integer | no | Number of candles (newest last). Without date: 1-2000 (Market Data plans; 1-1000 on other plans), default 100. With date: 1-1440, default the whole day (M1: 1440 candles). Default: 100. |
| `date` | query | string | no | UTC day, YYYY-MM-DD. |

Example `data`:

```json
{
    "broker": "quotex",
    "symbol": "EURUSD_otc",
    "timeframe": "M1",
    "candles": [
        {
            "time": "2026-10-05T07:27:00Z",
            "chart_open": true,
            "epoch": 1791185220,
            "open": 17800.91,
            "high": 17801.26,
            "low": 17799.7,
            "close": 17800.03,
            "payout": 89,
            "volume": 87
        },
        {
            "time": "2026-10-05T07:28:00Z",
            "chart_open": true,
            "epoch": 1791185280,
            "open": 17800.03,
            "high": 17800.08,
            "low": 17798.43,
            "close": 17798.6,
            "payout": 89,
            "volume": 124
        }
    ]
}
```

### `GET /v1/history`

Historical OHLC candles (UTC) of a range of days, oldest first, straight from the QUANTEX servers: every closed candle of every day, the same data the QUANTEX checker uses. M1: up to 7 days per request (10 080 candles); M5 and higher: up to 31 days. Same fields as /v1/candles. How far back you may ask depends on your plan (error history_limit).

- Key permission (scope): `history:read` · endpoint group: `history` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla (the ones your plan covers: Candle Basic 1, Candle Data 2, Full Market Data all 3; otherwise error broker_not_in_plan). One of: quotex, tradowix, binolla. Default: quotex. |
| `pair` | query | string | yes | Pair symbol from /v1/pairs, e.g. EURUSD_otc. |
| `tf` | query | string | no | Timeframe. One of: M1, M5, M15, M30, H1, H4. Default: M1. |
| `from` | query | string | yes | First UTC day, YYYY-MM-DD. |
| `to` | query | string | no | Last UTC day, YYYY-MM-DD (default: the same as from). |

Example `data`:

```json
{
    "broker": "quotex",
    "symbol": "EURUSD_otc",
    "timeframe": "M1",
    "from": "2026-10-03",
    "to": "2026-10-04",
    "count": 2880,
    "candles": [
        {
            "time": "2026-10-03T00:00:00Z",
            "chart_open": true,
            "epoch": 1790985600,
            "open": 1.16782,
            "high": 1.16801,
            "low": 1.16775,
            "close": 1.16796,
            "payout": 88,
            "volume": 0
        }
    ]
}
```

### `GET /v1/ticks`

The newest live tick of up to 20 pairs (QUOTEX, TRADOWIX and BINOLLA): price, bid, ask and the exact time in milliseconds (UTC), plus the broker's running M1 candle (open, high, low, close = price, seconds_left). Put it on top of /v1/candles and your chart moves exactly like the broker's. fresh=false: no new tick for 2 minutes (market closed or paused). available=false: no tick for this pair right now. For a moving chart use the tick stream (/v1/stream/ticks) instead of asking again and again.

- Key permission (scope): `ticks:read` · endpoint group: `ticks` · plans: —

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla. One of: quotex, tradowix, binolla. Default: quotex. |
| `pairs` | query | string | yes | Up to 20 pair symbols, comma-separated, e.g. EURUSD_otc,BTCUSD_otc. |

Example `data`:

```json
{
    "broker": "quotex",
    "server_time": "2026-10-05T10:31:24.512Z",
    "ticks": [
        {
            "symbol": "EURUSD_otc",
            "available": true,
            "price": 1.16834,
            "bid": 1.16831,
            "ask": 1.16837,
            "time": "2026-10-05T10:31:24.318Z",
            "epoch_ms": 1791196284318,
            "fresh": true,
            "candle": {
                "timeframe": "M1",
                "time": "2026-10-05T10:31:00Z",
                "epoch": 1791196260,
                "open": 1.16812,
                "high": 1.1684,
                "low": 1.16809,
                "close": 1.16834,
                "seconds_left": 36
            }
        }
    ]
}
```

### `GET /v1/stream/ticks`

Server-Sent Events: a "tick" event (same object as in /v1/ticks) every time the price of one of your pairs changes, checked about 4 times a second. When a minute closes the next tick carries the new candle, so a chart fed by this stream draws every candle like the broker. The stream closes after 5 minutes with event "reconnect"; open it again (EventSource does this by itself). At most 2 open streams per account.

- Key permission (scope): `ticks:read` · endpoint group: `ticks` · plans: —
- Content type: `text/event-stream`

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla. One of: quotex, tradowix, binolla. Default: quotex. |
| `pairs` | query | string | yes | Up to 20 pair symbols, comma-separated. |

### `GET /v1/openapi.json`

This API described as an OpenAPI 3.1 file. No key needed.

- No API key needed.

## Error codes

| code | HTTP | meaning |
|---|---|---|
| `unauthenticated` | 401 | No API key was sent. |
| `invalid_api_key` | 401 | The API key is not valid. |
| `key_revoked` | 403 | The key was revoked. |
| `key_expired` | 403 | The key has expired. |
| `account_suspended` | 403 | The account is suspended. |
| `ip_not_allowed` | 403 | The request came from an IP address that is not on the key's list. |
| `insufficient_scope` | 403 | The key does not have the permission this endpoint needs (error.required_scope). |
| `plan_upgrade_required` | 403 | Your plan does not include this endpoint group (error.required_group). |
| `history_limit` | 403 | The requested date is older than your plan's candle history. |
| `broker_not_in_plan` | 403 | Your plan does not cover this broker (error.allowed_brokers lists the ones it does). |
| `ticks_not_supported` | 422 | This broker has no live tick feed: use candles. |
| `range_too_large` | 422 | The date range is too long (M1: 7 days, M5 and higher: 31 days per request). |
| `not_found` | 404 | The endpoint does not exist. |
| `endpoint_unavailable` | 404 | The endpoint is not available right now. |
| `pair_not_found` | 404 | The pair is not available at this broker. |
| `method_not_allowed` | 405 | Wrong HTTP method for this endpoint. |
| `payload_too_large` | 413 | The request body is larger than 64 KB. |
| `validation_failed` | 422 | Some parameters are invalid (error.fields lists them). |
| `rate_limited` | 429 | Too many requests this minute (Retry-After header). |
| `quota_exceeded` | 429 | The monthly quota is used up (error.resets_at). |
| `too_many_streams` | 429 | Too many open streams for this account. |
| `internal_error` | 500 | Server problem; quote meta.request_id to support. |
| `service_unavailable` | 503 | Market data is temporarily unavailable (Retry-After header). |
| `busy` | 503 | The data service is busy; retry in a few seconds. |

## Plans

| Plan | Price (USDT / 30 days) | Brokers | Requests | API keys | What it opens |
|---|---|---|---|---|---|
| **Developer** | Free | all 3 | 10 / minute · 3,000 / month | 1 | status, account, brokers, pairs, payouts |
| **Candle Basic** | 15 | 1 of your choice | unlimited | 2 | + live **candles** M1–H4 (up to 2,000 per request) |
| **Candle Data API** | 30 | 2 of your choice | unlimited | 3 | + live **candles** M1–H4 (up to 2,000 per request) |
| **Full Market Data API** | 50 | all 3 | unlimited | 5 | + candles, **historical candles** and **live ticks** (REST + stream) |

You choose the broker(s) when you buy Candle Basic or Candle Data. Pay in **Dashboard → Upgrade plan** with Binance Pay, USDT TRC20 or USDT BEP20; the payment is verified automatically. Current prices: [quantexbot.pro/pricing](https://quantexbot.pro/pricing).

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
