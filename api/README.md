<sub>[🏠 Home](../README.md) · [📚 Docs](../docs/README.md) · [📘 User Guide](../docs/user-guide.md) · [🤖 Auto Trading](../docs/guide/14-auto-trading.md) · [🧩 Studio](../docs/studio.md) · [🔌 API](README.md) · [💰 Pricing](../docs/pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

<div align="center">

# 🔌 QUANTEX Developer API

**Market data and QUANTEX signals for your own apps, charts and bots: brokers, pairs, payouts, OHLC candles (M1 → H4), historical candles, live ticks, live signals with their results, future signal lists, the signal checker and economic news.**

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
| **Plans** | Signal API: Developer (free), Starter, Pro, Business · Market Data API: Candle Basic, Candle Data API, Full Market Data API — see [Plans](#plans) and [quantexbot.pro/pricing](https://quantexbot.pro/pricing) |
| **Machine-readable** | [OpenAPI 3.1](https://api.quantexbot.pro/v1/openapi.json) · [llms.txt](https://quantexbot.pro/llms.txt) · [full Markdown](https://quantexbot.pro/docs/api.md) · copy in this repo: [`api/openapi.json`](openapi.json) |
| **Live status** | [quantexbot.pro/status](https://quantexbot.pro/status) · JSON: [`GET /v1/status`](https://api.quantexbot.pro/v1/status) (no key) |
| **Code examples** | [`examples/`](../examples/) — Telegram signal bot, live candle chart, result checker, CSV export and webhook receiver in Python, Node.js and PHP |

### What you can build

- 📈 **Live candle charts** on your own website that move with every tick, like the broker's.
- 📊 **Dashboards and analytics** — the payout of every pair, OHLC candles M1 → H4, open markets.
- 🧪 **Backtests** — download every closed candle of any date range as CSV.
- 🤖 **Your own bots** — feed your strategy with the same market data QUANTEX uses.
- 📡 **Signal channels** — post every live QUANTEX signal and its WIN / LOSS to your Telegram chat, by polling, webhooks or the SSE stream.
- ✅ **Result checkers** — check any signal list (with martingale steps) against the real candles.
- 🗓️ **Future lists and news** — build future signal lists and follow high-impact economic news with its expected direction.

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
| POST | `/v1/checker` | Check a signal list: WIN / LOSS / NO_DATA with martingale steps | checker |
| GET | `/v1/news` | Upcoming economic events with the expected direction and the pairs to trade | news |
| GET | `/v1/signals/live` | Live signals the bot delivers, and their results (cursor polling) | signals |
| GET | `/v1/signals/{id}` | One signal with its result | signals |
| GET | `/v1/results` | Settled signals of a UTC day with the win rate | signals |
| POST | `/v1/future` | Start a future signal list (job) | future |
| GET | `/v1/jobs/{id}` | State and result of a future list job | future |
| GET | `/v1/stream/signals` | Server-Sent Events stream of new signals and results | stream |
| — | Webhooks | Signed POST of every new signal and result to your server (Dashboard → API → Webhooks) | webhooks |
| GET | `/v1/openapi.json` | This API as OpenAPI 3.1 (no key) | public |

> [!TIP]
> Two families, one key: the **Market Data API** (candles, history, ticks) and the **Signal API** (live signals and results, future lists, checker, news, webhooks, signal stream). Your plan decides which endpoint groups a key can use; `GET /v1/account` lists them.

---

## Introduction

The QUANTEX API gives your apps, charts and Telegram bots the same market data QUANTEX uses: the brokers and their OTC / Live pairs, current payouts, OHLC candles (M1 to H4), historical candles and live ticks. Every endpoint, parameter and example is listed in the **Endpoint reference** below.

It also gives the live signals the bot delivers with their results, future signal lists, the signal checker and the economic news calendar.

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

Node.js (18+):

```javascript
const API = "https://api.quantexbot.pro/v1";
const res = await fetch(`${API}/checker`, {
  method: "POST",
  headers: { "Authorization": "Bearer qx_live_YOUR_KEY", "Content-Type": "application/json" },
  body: JSON.stringify({ broker: "quotex", mtg: 1, date: "today", timezone: 6, text: "M1 EURUSD-OTC 14:05 CALL\nM1 GBPUSD-OTC 14:20 PUT" }),
});
const body = await res.json();
if (body.ok) console.log(body.data.summary);
else console.error(body.error.code, body.error.message);
```

PHP:

```php
<?php
$ch = curl_init('https://api.quantexbot.pro/v1/news?impact=high&days=1');
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ['Authorization: Bearer qx_live_YOUR_KEY'], CURLOPT_TIMEOUT => 15]);
$body = json_decode(curl_exec($ch), true);
foreach ($body['ok'] ? $body['data']['events'] : [] as $event) {
    echo $event['time'], ' ', $event['currency'], ' ', $event['title'], ' → ', $event['bias'] ?? 'no bias', PHP_EOL;
}
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

The same pattern works for the checker: collect your signals during the day, send them to `POST /v1/checker` in the evening and post the summary.

## Live signals and results

The live signals are the signals the QUANTEX bot really delivers to its Telegram users (Live Session, Auto Signal, Live Signal), each setup **once**, with its result after expiry. The API never starts a new analysis for a request, so polling is fast.

Poll every 2–5 seconds and pass the cursor of the last answer:

```bash
curl "https://api.quantexbot.pro/v1/signals/live?since=0&broker=quotex&tf=M1" \
  -H "Authorization: Bearer qx_live_YOUR_KEY"
```

- `active` — signals waiting for entry or running.
- `events` — `signal.created` (a new signal) and `signal.result` (its result), oldest first. Remember `next_cursor` and send it as `since` next time.
- Every signal has `entry_at` and `expiry_at` (UTC), `direction` (`CALL` / `PUT`), `payout`, `confidence` and `engine`. The result arrives later with the **same id**: `WIN` (`mtg_level` 0 = direct, 1 = after one martingale step), `LOSS` (also after one step) or `NO_DATA`.
- `GET /v1/signals/{id}` returns one signal; `GET /v1/results?date=YYYY-MM-DD` returns a day's settled signals with wins, losses and the win rate (30 days back).

A Python loop that posts each new signal to your Telegram channel:

```python
import time, requests

QX = {"Authorization": "Bearer qx_live_YOUR_KEY"}       # permission: signals:read
BOT, CHANNEL = "123456:ABC...", "@your_channel"
cursor = None

while True:
    params = {"broker": "quotex"} | ({"since": cursor} if cursor is not None else {})
    body = requests.get("https://api.quantexbot.pro/v1/signals/live", params=params, headers=QX, timeout=15).json()
    if body["ok"]:
        if cursor is not None:                                   # skip the history on the first call
            for ev in body["data"]["events"]:
                s = ev["signal"]
                text = (f"{s['pair']} {s['timeframe']} {s['direction']} at {s['entry_at'][11:16]} UTC"
                        if ev["type"] == "signal.created" else f"{s['pair']}: {s['result']}")
                requests.post(f"https://api.telegram.org/bot{BOT}/sendMessage", json={"chat_id": CHANNEL, "text": text}, timeout=15)
        cursor = body["data"]["next_cursor"]
    time.sleep(3)
```

## Webhooks

Instead of polling, let QUANTEX call your server: **Dashboard → API → Webhooks** → add your `https://` address. Each new `signal.created` and `signal.result` is POSTed within seconds as JSON `{"id", "type", "created_at", "data": {signal}}`.

- Check the header `X-Quantex-Signature: t=<unix time>,v1=<hex>`: HMAC-SHA256 of `"<t>.<raw body>"` with your webhook secret (shown once when you create it). Refuse requests older than 5 minutes.
- Answer with any 2xx status within 5 seconds. A failed delivery is tried again after 1, 5 and 30 minutes; after 10 deliveries in a row failed the webhook is turned off and you get an email.
- `X-Quantex-Event` holds the event type and `X-Quantex-Delivery` a delivery id (the same on every retry). Use **Send test** to try your endpoint.

## Signal stream (Server-Sent Events)

`GET /v1/stream/signals` keeps the connection open and sends every event the moment it arrives (`id:` is the cursor, `event:` the type, `data:` the event JSON). After 5 minutes the server ends the stream with `event: reconnect`; reconnect with the `Last-Event-ID` header and nothing is missed. At most 2 open streams per account.

```bash
curl -N "https://api.quantexbot.pro/v1/stream/signals?broker=quotex" -H "Authorization: Bearer qx_live_YOUR_KEY"
```

## Future signals

`POST /v1/future` makes a future signal list with the same generators as the bot's **Future Signal** (OTC, Live, Blackout, Whiteout). It answers `202` with a job at once; ask `GET /v1/jobs/{id}` every few seconds until `status` is `done` (or `failed` with the reason).

```bash
curl -X POST "https://api.quantexbot.pro/v1/future" \
  -H "Authorization: Bearer qx_live_YOUR_KEY" -H "Content-Type: application/json" \
  -d '{"mode": "otc", "start": "18:00", "end": "22:00", "timezone": 6, "system": 1, "strategy": 1, "pairs": ["EURUSD_otc", "USDJPY_otc"]}'
```

## Usage guide

- **Dashboard → API overview** shows your plan, limits and today's activity; **API usage** shows requests per day and per endpoint; **API logs** lists every request of the last 90 days (request bodies and keys are never stored).
- **My APIs** shows which endpoint groups your plan includes. Endpoints outside your plan answer `403 plan_upgrade_required`; upgrade in **Billing → Upgrade plan**.
- Questions? Visit the [contact](https://quantexbot.pro/contact) page; news about the API is posted on the [main channel](https://t.me/bdtraderpro).

- Live signals, results and future lists need the **signals:read** / **future:generate** permissions on the key; webhooks and the stream are in the Pro and Business plans.

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

### Telegram bot: checker, live signals, candles, news

One bot with every API tool: best payouts, live price, candles, the result checker, today's results, high impact news, future signal lists, and live QUANTEX signals posted to your chat with their WIN / LOSS as a reply.

Endpoint groups: Brokers & pairs, Payouts, Candles (OHLC), Live ticks, Signal checker, Live signals & results, Future signals, Economic news. Result: Open your bot in Telegram and send /help. Send /live on in a chat or channel (the bot must be an admin of a channel) and every new signal and its result is posted there.

#### Python — install: `pip install requests` · set `QX_API_KEY` · set `TG_BOT_TOKEN` · run: `python bot.py`

`bot.py`:

```python
"""
QUANTEX API - complete Telegram bot (Python 3.9+)

Commands
  /pairs                       best paying open OTC pairs
  /price EURUSD_otc            newest live tick of a pair
  /candles EURUSD_otc M5 10    the last candles of a pair
  /check  (+ your list)        WIN / LOSS of a signal list (result checker)
  /results                     today's results of the QUANTEX live signals
  /news                        today's high impact news with direction
  /future 18:00 22:00          a future signal list
  /live on | /live off         post every QUANTEX live signal and its result here

Run
  pip install requests
  export QX_API_KEY="qx_live_..."        (Windows: set QX_API_KEY=qx_live_...)
  export TG_BOT_TOKEN="123456:ABC..."    (from @BotFather)
  python bot.py
"""
import json
import os
import threading
import time
from datetime import datetime, timedelta, timezone

import requests

QX_API = os.environ.get("QX_API", "https://api.quantexbot.pro/v1")
QX_KEY = os.environ["QX_API_KEY"]
TG_API = os.environ.get("TG_API", "https://api.telegram.org") + "/bot" + os.environ["TG_BOT_TOKEN"]
BROKER = os.environ.get("QX_BROKER", "quotex")           # quotex, tradowix or binolla
TZ = float(os.environ.get("QX_TZ", "6"))                  # your UTC offset, e.g. 6 for Bangladesh
SUBSCRIBERS_FILE = "subscribers.json"

http = requests.Session()
http.headers["Authorization"] = f"Bearer {QX_KEY}"
lock = threading.Lock()


class QuantexError(Exception):
    pass


# ---------------------------------------------------------------- QUANTEX API
def qx(method, path, params=None, body=None):
    """Call the QUANTEX API and return `data`, or raise QuantexError."""
    for attempt in range(3):
        r = http.request(method, QX_API + path, params=params, json=body, timeout=30)
        if r.status_code == 429 and attempt < 2:              # rate limit: wait as told, then retry
            time.sleep(int(r.headers.get("Retry-After", "5")))
            continue
        answer = r.json()
        if answer.get("ok"):
            return answer["data"]
        raise QuantexError(f"{answer['error']['code']}: {answer['error']['message']}")


# ---------------------------------------------------------------- Telegram
def tg(method, **params):
    r = requests.post(f"{TG_API}/{method}", json=params, timeout=40)
    return r.json().get("result")


def reply(chat_id, text, reply_to=None):
    for start in range(0, len(text), 4000):                  # Telegram allows 4096 characters
        msg = tg("sendMessage", chat_id=chat_id, text=text[start:start + 4000],
                 reply_to_message_id=reply_to, allow_sending_without_reply=True)
    return msg


# ---------------------------------------------------------------- helpers
def local_time(iso):
    """'2026-10-05T10:31:00Z' -> '16:31' in your timezone."""
    t = datetime.fromisoformat(iso.replace("Z", "+00:00")) + timedelta(hours=TZ)
    return t.strftime("%H:%M")


def arrow(direction):
    return "🟢 CALL" if direction in ("CALL", "BUY") else "🔴 PUT"


def result_icon(result, level=0):
    if result == "WIN":
        return "✅ WIN" if not level else f"✅ WIN (MTG {level})"
    return {"LOSS": "❌ LOSS", "NO_DATA": "⚪ NO DATA"}.get(result, result)


# ---------------------------------------------------------------- commands
HELP = """QUANTEX bot
/pairs - best paying open OTC pairs
/price EURUSD_otc - live price
/candles EURUSD_otc M5 10 - last candles
/check + your list on the next lines - WIN / LOSS
/results - today's QUANTEX results
/news - high impact news today
/future 18:00 22:00 - future signal list
/live on | /live off - live signals in this chat"""


def cmd_help(args, text):
    return HELP


def cmd_pairs(args, text):
    pairs = qx("GET", "/payouts", {"broker": BROKER, "market": "otc"})
    lines = [f"{p['name']:<18} {p['payout']}%" for p in pairs if p["open"]][:15]
    return "Best payouts now:\n" + "\n".join(lines) if lines else "No open pair right now."


def cmd_price(args, text):
    if not args:
        return "Write: /price EURUSD_otc"
    data = qx("GET", "/ticks", {"broker": BROKER, "pairs": args[0]})
    t = data["ticks"][0]
    if not t["available"]:
        return f"{args[0]}: no live price right now."
    c = t.get("candle") or {}
    out = f"{t['symbol']}  {t['price']}\n{local_time(t['time'])} (your time)"
    if c:
        out += f"\nM1 candle: O {c['open']}  H {c['high']}  L {c['low']}  · {c['seconds_left']}s left"
    return out


def cmd_candles(args, text):
    if not args:
        return "Write: /candles EURUSD_otc M5 10"
    pair = args[0]
    tf = args[1].upper() if len(args) > 1 else "M1"
    limit = int(args[2]) if len(args) > 2 else 10
    data = qx("GET", "/candles", {"broker": BROKER, "pair": pair, "tf": tf, "limit": min(limit, 30)})
    lines = []
    for c in data["candles"]:
        color = "🟢" if c["close"] >= c["open"] else "🔴"
        lines.append(f"{local_time(c['time'])} {color} O {c['open']}  C {c['close']}")
    ups = sum(1 for c in data["candles"] if c["close"] >= c["open"])
    return f"{pair} {tf} - last {len(lines)} candles ({ups} up, {len(lines) - ups} down)\n" + "\n".join(lines)


def cmd_check(args, text):
    # Everything after the first line is the list, e.g. "M1 EURUSD-OTC 14:05 CALL"
    signals = "\n".join(text.splitlines()[1:]).strip()
    if not signals:
        return "Send /check and your list on the next lines:\n/check\nM1 EURUSD-OTC 14:05 CALL\nM1 USDJPY-OTC 14:20 PUT"
    data = qx("POST", "/checker", body={"broker": BROKER, "text": signals, "mtg": 1, "date": "today", "timezone": TZ})
    lines = [f"{r['time']} {r['pair']} {arrow(r['direction'])} → {result_icon(r['result'], r.get('mtg_level') or 0)}"
             for r in data["results"]]
    s = data["summary"]
    lines.append(f"\nWins {s['wins']} · Losses {s['losses']} · Win rate {s['win_rate']}%")
    if data.get("rejected"):
        lines.append(f"Not understood: {len(data['rejected'])} line(s)")
    return "\n".join(lines)


def cmd_results(args, text):
    data = qx("GET", "/results", {"broker": BROKER})
    s = data["summary"]
    if not s["total"]:
        return f"No settled QUANTEX signal yet on {data['date']} (UTC)."
    return (f"QUANTEX live signals {data['date']} (UTC)\n"
            f"Signals {s['total']} · Wins {s['wins']} · MTG wins {s['mtg_wins']} · Losses {s['losses']}\n"
            f"Win rate {s['win_rate']}% (direct {s['win_rate_no_mtg']}%)")


def cmd_news(args, text):
    data = qx("GET", "/news", {"impact": "high", "days": 1, "timezone": TZ})
    lines = []
    for e in data["events"]:
        bias = {"bullish": "⬆️", "bearish": "⬇️"}.get(e.get("bias"), "•")
        lines.append(f"{local_time(e['time'])} {e['currency']} {bias} {e['title']}")
    return "High impact news today:\n" + "\n".join(lines) if lines else "No high impact news left today."


def cmd_future(args, text):
    start, end = (args + ["00:00", "23:59"])[:2] if args else ("00:00", "23:59")
    job = qx("POST", "/future", body={"mode": "otc", "broker": BROKER, "start": start, "end": end,
                                       "timezone": TZ, "system": 1, "strategy": 1, "quantity": 2})
    for _ in range(30):                                      # the list is usually ready in a few seconds
        time.sleep(2)
        job = qx("GET", f"/jobs/{job['id']}")
        if job["status"] in ("done", "failed"):
            break
    if job["status"] != "done":
        return "The list is not ready: " + ((job.get("error") or {}).get("message") or job["status"])
    sig = job["result"]["signals"]
    lines = [f"{s['time']} {s['pair']} {arrow(s['direction'])}" for s in sig]
    return f"Future signals {start}-{end}:\n" + "\n".join(lines) if lines else "No signal in this time range."


def cmd_live(args, text, chat_id):
    with lock:
        subs = load_subscribers()
        if args and args[0].lower() == "off":
            subs.discard(chat_id)
            answer = "Live signals stopped for this chat."
        else:
            subs.add(chat_id)
            answer = "Live signals are on. Every new QUANTEX signal and its result is posted here."
        save_subscribers(subs)
    return answer


COMMANDS = {"start": cmd_help, "help": cmd_help, "pairs": cmd_pairs, "price": cmd_price, "candles": cmd_candles,
            "check": cmd_check, "results": cmd_results, "news": cmd_news, "future": cmd_future}


def handle(message):
    text = message.get("text") or ""
    if not text.startswith("/"):
        return
    chat_id = message["chat"]["id"]
    first = text.splitlines()[0].split()
    name, args = first[0][1:].split("@")[0].lower(), first[1:]
    try:
        if name == "live":
            answer = cmd_live(args, text, chat_id)
        elif name in COMMANDS:
            answer = COMMANDS[name](args, text)
        else:
            answer = "Unknown command. Send /help"
    except QuantexError as e:
        answer = f"⚠️ {e}"
    except Exception as e:                                    # network problem etc.
        answer = f"⚠️ Try again in a moment ({type(e).__name__})"
    reply(chat_id, answer, message["message_id"])


# ---------------------------------------------------------------- live signals
def load_subscribers():
    try:
        with open(SUBSCRIBERS_FILE) as f:
            return set(json.load(f))
    except (OSError, ValueError):
        return set()


def save_subscribers(subs):
    with open(SUBSCRIBERS_FILE, "w") as f:
        json.dump(sorted(subs), f)


def live_signals_loop():
    cursor = None
    posted = {}                                               # signal id -> {chat id: message id}
    while True:
        try:
            params = {"broker": BROKER}
            if cursor is not None:
                params["since"] = cursor
            data = qx("GET", "/signals/live", params)
            if cursor is not None:                            # the first answer only sets the cursor
                with lock:
                    subs = load_subscribers()
                for ev in data["events"]:
                    s = ev["signal"]
                    if ev["type"] == "signal.created":
                        text = (f"📊 {s['pair']} · {s['timeframe']}\n{arrow(s['direction'])}\n"
                                f"Entry {local_time(s['entry_at'])} · Payout {s['payout']}% · Confidence {s['confidence']}%")
                        posted[s["id"]] = {c: (reply(c, text) or {}).get("message_id") for c in subs}
                    elif ev["type"] == "signal.result":
                        sent = posted.pop(s["id"], {})
                        for c in subs:
                            reply(c, f"{s['pair']} {s['direction']} → {result_icon(s['result'], s.get('mtg_level') or 0)}", sent.get(c))
            cursor = data["next_cursor"]
        except Exception as e:
            print("signals:", e)
        time.sleep(3)


# ---------------------------------------------------------------- main
def main():
    me = tg("getMe")
    print(f"Bot @{me['username']} is running. Press Ctrl+C to stop.")
    threading.Thread(target=live_signals_loop, daemon=True).start()
    offset = 0
    while True:
        try:
            updates = tg("getUpdates", offset=offset, timeout=25) or []
        except requests.RequestException:
            time.sleep(3)
            continue
        for u in updates:
            offset = u["update_id"] + 1
            if "message" in u:
                threading.Thread(target=handle, args=(u["message"],), daemon=True).start()


if __name__ == "__main__":
    main()
```

#### Node.js — set `QX_API_KEY` · set `TG_BOT_TOKEN` · run: `node bot.js`

`bot.js`:

```javascript
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
```

#### PHP — set `QX_API_KEY` · set `TG_BOT_TOKEN` · run: `php bot.php`

`bot.php`:

```php
<?php
/*
 * QUANTEX API - complete Telegram bot (PHP 8.0+, curl extension)
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
 * Run (from a terminal, it keeps running)
 *   export QX_API_KEY="qx_live_..."        (Windows: set QX_API_KEY=qx_live_...)
 *   export TG_BOT_TOKEN="123456:ABC..."    (from @BotFather)
 *   php bot.php
 */

$QX_API = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$QX_KEY = getenv('QX_API_KEY') ?: exit("Set QX_API_KEY first.\n");
$TG_API = (getenv('TG_API') ?: 'https://api.telegram.org').'/bot'.(getenv('TG_BOT_TOKEN') ?: exit("Set TG_BOT_TOKEN first.\n"));
$BROKER = getenv('QX_BROKER') ?: 'quotex';          // quotex, tradowix or binolla
$TZ = (float) (getenv('QX_TZ') ?: 6);              // your UTC offset, e.g. 6 for Bangladesh
const SUBSCRIBERS_FILE = __DIR__.'/subscribers.json';

class QuantexError extends Exception {}

// ---------------------------------------------------------------- QUANTEX API
/** Call the QUANTEX API and return `data`, or throw QuantexError. */
function qx(string $method, string $path, array $params = [], ?array $body = null): array
{
    global $QX_API, $QX_KEY;
    $url = $QX_API.$path.($params ? '?'.http_build_query($params) : '');
    for ($attempt = 0; $attempt < 3; $attempt++) {
        $ch = curl_init($url);
        $retryAfter = 5;
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$QX_KEY, 'Content-Type: application/json'],
            CURLOPT_POSTFIELDS => $body !== null ? json_encode($body) : null,
            CURLOPT_HEADERFUNCTION => function ($ch, $line) use (&$retryAfter) {
                if (stripos($line, 'Retry-After:') === 0) { $retryAfter = (int) trim(substr($line, 12)); }
                return strlen($line);
            },
        ]);
        $raw = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);
        if ($raw === false) {
            throw new RuntimeException('QUANTEX API not reachable');
        }
        if ($status === 429 && $attempt < 2) {            // rate limit: wait as told, then retry
            sleep(max(1, $retryAfter));
            continue;
        }
        $answer = json_decode($raw, true);
        if (! empty($answer['ok'])) {
            return $answer['data'];
        }
        throw new QuantexError($answer['error']['code'].': '.$answer['error']['message']);
    }
    throw new QuantexError('rate_limited: too many requests');
}

// ---------------------------------------------------------------- Telegram
function tg(string $method, array $params = [])
{
    global $TG_API;
    $ch = curl_init("$TG_API/$method");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 40,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($params),
    ]);
    $raw = curl_exec($ch);
    curl_close($ch);

    return $raw === false ? null : (json_decode($raw, true)['result'] ?? null);
}

function reply($chatId, string $text, ?int $replyTo = null)
{
    $msg = null;
    foreach (mb_str_split($text, 4000) as $part) {     // Telegram allows 4096 characters
        $msg = tg('sendMessage', ['chat_id' => $chatId, 'text' => $part,
            'reply_to_message_id' => $replyTo, 'allow_sending_without_reply' => true]);
    }

    return $msg;
}

// ---------------------------------------------------------------- helpers
/** "2026-10-05T10:31:00Z" -> "16:31" in your timezone. */
function toLocal(string $iso): string
{
    global $TZ;

    return gmdate('H:i', strtotime($iso) + (int) round($TZ * 3600));
}

function arrow(string $d): string
{
    return in_array($d, ['CALL', 'BUY'], true) ? '🟢 CALL' : '🔴 PUT';
}

function resultIcon(string $result, int $level = 0): string
{
    if ($result === 'WIN') {
        return $level ? "✅ WIN (MTG $level)" : '✅ WIN';
    }

    return ['LOSS' => '❌ LOSS', 'NO_DATA' => '⚪ NO DATA'][$result] ?? $result;
}

// ---------------------------------------------------------------- commands
const HELP = "QUANTEX bot
/pairs - best paying open OTC pairs
/price EURUSD_otc - live price
/candles EURUSD_otc M5 10 - last candles
/check + your list on the next lines - WIN / LOSS
/results - today's QUANTEX results
/news - high impact news today
/future 18:00 22:00 - future signal list
/live on | /live off - live signals in this chat";

function command(string $name, array $args, string $text, $chatId): string
{
    global $BROKER, $TZ;
    switch ($name) {
        case 'start':
        case 'help':
            return HELP;

        case 'pairs':
            $lines = [];
            foreach (qx('GET', '/payouts', ['broker' => $BROKER, 'market' => 'otc']) as $p) {
                if ($p['open'] && count($lines) < 15) {
                    $lines[] = str_pad($p['name'], 18).' '.$p['payout'].'%';
                }
            }
            return $lines ? "Best payouts now:\n".implode("\n", $lines) : 'No open pair right now.';

        case 'price':
            if (! isset($args[0])) { return 'Write: /price EURUSD_otc'; }
            $t = qx('GET', '/ticks', ['broker' => $BROKER, 'pairs' => $args[0]])['ticks'][0];
            if (! $t['available']) { return "$args[0]: no live price right now."; }
            $out = "{$t['symbol']}  {$t['price']}\n".toLocal($t['time']).' (your time)';
            if ($c = $t['candle']) {
                $out .= "\nM1 candle: O {$c['open']}  H {$c['high']}  L {$c['low']}  · {$c['seconds_left']}s left";
            }
            return $out;

        case 'candles':
            if (! isset($args[0])) { return 'Write: /candles EURUSD_otc M5 10'; }
            $tf = strtoupper($args[1] ?? 'M1');
            $data = qx('GET', '/candles', ['broker' => $BROKER, 'pair' => $args[0], 'tf' => $tf, 'limit' => min((int) ($args[2] ?? 10), 30)]);
            $lines = [];
            $ups = 0;
            foreach ($data['candles'] as $c) {
                $up = $c['close'] >= $c['open'];
                $ups += $up ? 1 : 0;
                $lines[] = toLocal($c['time']).' '.($up ? '🟢' : '🔴')." O {$c['open']}  C {$c['close']}";
            }
            return "$args[0] $tf - last ".count($lines)." candles ($ups up, ".(count($lines) - $ups)." down)\n".implode("\n", $lines);

        case 'check':
            // Everything after the first line is the list, e.g. "M1 EURUSD-OTC 14:05 CALL"
            $signals = trim(implode("\n", array_slice(explode("\n", $text), 1)));
            if ($signals === '') {
                return "Send /check and your list on the next lines:\n/check\nM1 EURUSD-OTC 14:05 CALL\nM1 USDJPY-OTC 14:20 PUT";
            }
            $data = qx('POST', '/checker', [], ['broker' => $BROKER, 'text' => $signals, 'mtg' => 1, 'date' => 'today', 'timezone' => $TZ]);
            $lines = [];
            foreach ($data['results'] as $r) {
                $lines[] = "{$r['time']} {$r['pair']} ".arrow($r['direction']).' → '.resultIcon($r['result'], (int) ($r['mtg_level'] ?? 0));
            }
            $s = $data['summary'];
            $lines[] = "\nWins {$s['wins']} · Losses {$s['losses']} · Win rate {$s['win_rate']}%";
            if (! empty($data['rejected'])) { $lines[] = 'Not understood: '.count($data['rejected']).' line(s)'; }
            return implode("\n", $lines);

        case 'results':
            $data = qx('GET', '/results', ['broker' => $BROKER]);
            $s = $data['summary'];
            if (! $s['total']) { return "No settled QUANTEX signal yet on {$data['date']} (UTC)."; }
            return "QUANTEX live signals {$data['date']} (UTC)\n"
                ."Signals {$s['total']} · Wins {$s['wins']} · MTG wins {$s['mtg_wins']} · Losses {$s['losses']}\n"
                ."Win rate {$s['win_rate']}% (direct {$s['win_rate_no_mtg']}%)";

        case 'news':
            $lines = [];
            foreach (qx('GET', '/news', ['impact' => 'high', 'days' => 1, 'timezone' => $TZ])['events'] as $e) {
                $bias = ['bullish' => '⬆️', 'bearish' => '⬇️'][$e['bias'] ?? ''] ?? '•';
                $lines[] = toLocal($e['time'])." {$e['currency']} $bias {$e['title']}";
            }
            return $lines ? "High impact news today:\n".implode("\n", $lines) : 'No high impact news left today.';

        case 'future':
            [$start, $end] = [$args[0] ?? '00:00', $args[1] ?? '23:59'];
            $job = qx('POST', '/future', [], ['mode' => 'otc', 'broker' => $BROKER, 'start' => $start, 'end' => $end,
                'timezone' => $TZ, 'system' => 1, 'strategy' => 1, 'quantity' => 2]);
            for ($i = 0; $i < 30 && ! in_array($job['status'], ['done', 'failed'], true); $i++) {
                sleep(2);                                   // usually ready in a few seconds
                $job = qx('GET', '/jobs/'.$job['id']);
            }
            if ($job['status'] !== 'done') { return 'The list is not ready: '.($job['error']['message'] ?? $job['status']); }
            $lines = array_map(fn ($s) => "{$s['time']} {$s['pair']} ".arrow($s['direction']), $job['result']['signals']);
            return $lines ? "Future signals $start-$end:\n".implode("\n", $lines) : 'No signal in this time range.';

        case 'live':
            $subs = loadSubscribers();
            if (strtolower($args[0] ?? '') === 'off') {
                $subs = array_values(array_diff($subs, [$chatId]));
                saveSubscribers($subs);
                return 'Live signals stopped for this chat.';
            }
            saveSubscribers(array_values(array_unique([...$subs, $chatId])));
            return 'Live signals are on. Every new QUANTEX signal and its result is posted here.';
    }

    return 'Unknown command. Send /help';
}

function handle(array $message): void
{
    $text = $message['text'] ?? '';
    if ($text === '' || $text[0] !== '/') {
        return;
    }
    $first = preg_split('/\s+/', trim(explode("\n", $text)[0]));
    $name = strtolower(explode('@', substr($first[0], 1))[0]);
    try {
        $answer = command($name, array_slice($first, 1), $text, $message['chat']['id']);
    } catch (QuantexError $e) {
        $answer = '⚠️ '.$e->getMessage();
    } catch (Throwable $e) {
        $answer = '⚠️ Try again in a moment';
    }
    reply($message['chat']['id'], $answer, $message['message_id']);
}

// ---------------------------------------------------------------- live signals
function loadSubscribers(): array
{
    return is_file(SUBSCRIBERS_FILE) ? (json_decode(file_get_contents(SUBSCRIBERS_FILE), true) ?: []) : [];
}

function saveSubscribers(array $subs): void
{
    file_put_contents(SUBSCRIBERS_FILE, json_encode($subs));
}

/** One round of /v1/signals/live; $cursor and $posted keep their values between calls. */
function checkSignals(?int &$cursor, array &$posted): void
{
    global $BROKER;
    $params = ['broker' => $BROKER] + ($cursor !== null ? ['since' => $cursor] : []);
    $data = qx('GET', '/signals/live', $params);
    if ($cursor !== null) {                              // the first answer only sets the cursor
        $subs = loadSubscribers();
        foreach ($data['events'] as $ev) {
            $s = $ev['signal'];
            if ($ev['type'] === 'signal.created') {
                $text = "📊 {$s['pair']} · {$s['timeframe']}\n".arrow($s['direction'])."\n"
                    .'Entry '.toLocal($s['entry_at'])." · Payout {$s['payout']}% · Confidence {$s['confidence']}%";
                foreach ($subs as $c) {
                    $posted[$s['id']][$c] = reply($c, $text)['message_id'] ?? null;
                }
            } elseif ($ev['type'] === 'signal.result') {
                foreach ($subs as $c) {
                    reply($c, "{$s['pair']} {$s['direction']} → ".resultIcon($s['result'], (int) ($s['mtg_level'] ?? 0)), $posted[$s['id']][$c] ?? null);
                }
                unset($posted[$s['id']]);
            }
        }
    }
    $cursor = $data['next_cursor'];
}

// ---------------------------------------------------------------- main
$me = tg('getMe') ?? exit("Telegram token is not valid.\n");
echo "Bot @{$me['username']} is running. Press Ctrl+C to stop.\n";
$offset = 0;
$cursor = null;
$posted = [];
$nextSignals = 0;
while (true) {
    // Short long-poll (2 s) so the live signals are checked every few seconds too.
    foreach (tg('getUpdates', ['offset' => $offset, 'timeout' => 2]) ?? [] as $u) {
        $offset = $u['update_id'] + 1;
        if (isset($u['message'])) {
            handle($u['message']);
        }
    }
    if (time() >= $nextSignals) {
        try {
            checkSignals($cursor, $posted);
        } catch (Throwable $e) {
            echo 'signals: ', $e->getMessage(), "\n";
        }
        $nextSignals = time() + 3;
    }
}
```

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

### Result checker from a file

Write your signals in signals.txt (one per line, the same format as the bot) and get WIN / LOSS / NO DATA for each one with martingale, the win rate and a results.csv for Excel.

Endpoint groups: Signal checker. Result: A table with the result of each signal, the summary and results.csv in the folder.

#### Python — install: `pip install requests` · set `QX_API_KEY` · run: `python checker.py`

`checker.py`:

```python
"""
QUANTEX API - result checker from a file (Python 3.8+)

Reads signals.txt (one signal per line, e.g. "M1 EURUSD-OTC 14:05 CALL"),
checks every signal with POST /v1/checker and writes results.csv.

Run
  pip install requests
  export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
  python checker.py                    today, times in UTC+6
  python checker.py 2026-10-04 5.5     another day and timezone
"""
import csv
import os
import sys

import requests

QX_API = os.environ.get("QX_API", "https://api.quantexbot.pro/v1")
KEY = os.environ["QX_API_KEY"]

day = sys.argv[1] if len(sys.argv) > 1 else "today"        # today, yesterday or YYYY-MM-DD (30 days back)
tz = float(sys.argv[2]) if len(sys.argv) > 2 else 6        # UTC offset of the times in the list

with open("signals.txt", encoding="utf-8") as f:
    text = f.read()

r = requests.post(f"{QX_API}/checker", timeout=60,
                  headers={"Authorization": f"Bearer {KEY}"},
                  json={"broker": "quotex", "text": text, "mtg": 1, "date": day, "timezone": tz})
answer = r.json()
if not answer["ok"]:
    sys.exit(f"Error {answer['error']['code']}: {answer['error']['message']}")

data = answer["data"]
print(f"{'TIME':<6} {'PAIR':<14} {'DIR':<5} RESULT")
for x in data["results"]:
    mtg = f" (MTG {x['mtg_level']})" if x["result"] == "WIN" and x.get("mtg_level") else ""
    print(f"{x['time']:<6} {x['pair']:<14} {x['direction']:<5} {x['result']}{mtg}")

s = data["summary"]
print(f"\nTotal {s['total']} | Wins {s['wins']} | Losses {s['losses']} | No data {s['no_data']} | Win rate {s['win_rate']}%")
for line in data["rejected"]:
    print("Not understood:", line)

with open("results.csv", "w", newline="", encoding="utf-8") as f:
    w = csv.writer(f)
    w.writerow(["time", "pair", "direction", "timeframe", "result", "mtg_level", "payout"])
    for x in data["results"]:
        w.writerow([x["time"], x["pair"], x["direction"], x["timeframe"], x["result"], x.get("mtg_level"), x.get("payout")])
print("Saved results.csv")
```

`signals.txt`:

```text
M1 EURUSD-OTC 14:05 CALL
M1 USDJPY-OTC 14:20 PUT
M5 GBPUSD-OTC 15:00 CALL
```

#### Node.js — set `QX_API_KEY` · run: `node checker.js`

`checker.js`:

```javascript
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
```

`signals.txt`:

```text
M1 EURUSD-OTC 14:05 CALL
M1 USDJPY-OTC 14:20 PUT
M5 GBPUSD-OTC 15:00 CALL
```

#### PHP — set `QX_API_KEY` · run: `php checker.php`

`checker.php`:

```php
<?php
/*
 * QUANTEX API - result checker from a file (PHP 8.0+, curl extension)
 *
 * Reads signals.txt (one signal per line, e.g. "M1 EURUSD-OTC 14:05 CALL"),
 * checks every signal with POST /v1/checker and writes results.csv.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   php checker.php                      today, times in UTC+6
 *   php checker.php 2026-10-04 5.5       another day and timezone
 */
$api = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$key = getenv('QX_API_KEY');
$day = $argv[1] ?? 'today';               // today, yesterday or YYYY-MM-DD (30 days back)
$tz = (float) ($argv[2] ?? 6);            // UTC offset of the times in the list

$ch = curl_init("$api/checker");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Authorization: Bearer $key", 'Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode(['broker' => 'quotex', 'text' => file_get_contents(__DIR__.'/signals.txt'),
        'mtg' => 1, 'date' => $day, 'timezone' => $tz]),
]);
$answer = json_decode((string) curl_exec($ch), true);
curl_close($ch);
if (empty($answer['ok'])) {
    exit('Error '.($answer['error']['code'] ?? 'network').': '.($answer['error']['message'] ?? 'no answer')."\n");
}

$data = $answer['data'];
printf("%-6s %-14s %-5s %s\n", 'TIME', 'PAIR', 'DIR', 'RESULT');
foreach ($data['results'] as $x) {
    $mtg = $x['result'] === 'WIN' && ! empty($x['mtg_level']) ? " (MTG {$x['mtg_level']})" : '';
    printf("%-6s %-14s %-5s %s%s\n", $x['time'], $x['pair'], $x['direction'], $x['result'], $mtg);
}
$s = $data['summary'];
echo "\nTotal {$s['total']} | Wins {$s['wins']} | Losses {$s['losses']} | No data {$s['no_data']} | Win rate {$s['win_rate']}%\n";
foreach ($data['rejected'] as $line) {
    echo 'Not understood: ', is_string($line) ? $line : json_encode($line), "\n";
}

$f = fopen(__DIR__.'/results.csv', 'w');
fputcsv($f, ['time', 'pair', 'direction', 'timeframe', 'result', 'mtg_level', 'payout']);
foreach ($data['results'] as $x) {
    fputcsv($f, [$x['time'], $x['pair'], $x['direction'], $x['timeframe'], $x['result'], $x['mtg_level'] ?? '', $x['payout'] ?? '']);
}
fclose($f);
echo "Saved results.csv\n";
```

`signals.txt`:

```text
M1 EURUSD-OTC 14:05 CALL
M1 USDJPY-OTC 14:20 PUT
M5 GBPUSD-OTC 15:00 CALL
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

### Receive signals with webhooks

Instead of asking every few seconds, QUANTEX sends each new signal and its result to your server. This receiver checks the signature, ignores repeats and forwards the signal to Telegram.

Endpoint groups: Webhooks. Result: Every new signal and result is printed (and posted to your Telegram chat when TG_BOT_TOKEN and TG_CHAT are set).

#### Python — install: `pip install flask requests` · set `QX_WEBHOOK_SECRET` · run: `python webhook.py`

`webhook.py`:

```python
"""
QUANTEX API - webhook receiver (Python 3.8+, Flask)

QUANTEX POSTs every new signal (signal.created) and its result (signal.result)
to your https:// address. This server checks the signature and forwards the
signal to your Telegram channel.

Run
  pip install flask requests
  export QX_WEBHOOK_SECRET="whsec_..."   (shown once when you add the webhook)
  export TG_BOT_TOKEN="123456:ABC..."    (optional: post to Telegram)
  export TG_CHAT="@your_channel"         (optional)
  python webhook.py                      listens on port 8000, path /quantex
Then put it behind https (nginx, Caddy, Cloudflare Tunnel ...) and add
https://your-domain/quantex in Dashboard -> API -> Webhooks.
"""
import hashlib
import hmac
import json
import os
import time

import requests
from flask import Flask, abort, request

SECRET = os.environ["QX_WEBHOOK_SECRET"].encode()
TG_TOKEN = os.environ.get("TG_BOT_TOKEN")
TG_CHAT = os.environ.get("TG_CHAT")
app = Flask(__name__)
seen = set()                                   # delivery ids already handled (retries send the same id)


def valid_signature(raw: bytes, header: str) -> bool:
    """X-Quantex-Signature: t=<unix time>,v1=<hex HMAC-SHA256 of "<t>.<raw body>">"""
    parts = dict(p.split("=", 1) for p in header.split(",") if "=" in p)
    t, sig = parts.get("t", ""), parts.get("v1", "")
    if not t.isdigit() or abs(time.time() - int(t)) > 300:          # older than 5 minutes: refuse
        return False
    expected = hmac.new(SECRET, f"{t}.".encode() + raw, hashlib.sha256).hexdigest()
    return hmac.compare_digest(expected, sig)


@app.post("/quantex")
def quantex():
    raw = request.get_data()                   # the raw bytes: the signature is made over them
    if not valid_signature(raw, request.headers.get("X-Quantex-Signature", "")):
        abort(401)
    delivery = request.headers.get("X-Quantex-Delivery")
    if delivery in seen:
        return "", 200                         # already handled
    seen.add(delivery)

    event = json.loads(raw)
    s = event["data"]
    if event["type"] == "signal.created":
        text = f"📊 {s['pair']} {s['timeframe']} {s['direction']} - entry {s['entry_at'][11:16]} UTC, payout {s['payout']}%"
    elif event["type"] == "signal.result":
        text = f"{s['pair']} {s['direction']}: {s['result']}" + (f" (MTG {s['mtg_level']})" if s.get("mtg_level") else "")
    else:                                      # "ping" from the Send test button
        text = "QUANTEX webhook test received ✅"
    print(text)
    if TG_TOKEN and TG_CHAT:
        requests.post(f"https://api.telegram.org/bot{TG_TOKEN}/sendMessage", json={"chat_id": TG_CHAT, "text": text}, timeout=4)
    return "", 200                             # answer 2xx within 5 seconds


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=int(os.environ.get("PORT", "8000")))
```

#### Node.js — set `QX_WEBHOOK_SECRET` · run: `node webhook.js`

`webhook.js`:

```javascript
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
```

#### PHP — Upload webhook.php to your website, open it and write your webhook secret (and, if you like, your bot token and chat). Add its https:// address in Dashboard → API → Webhooks and press Send test.

`webhook.php`:

```php
<?php
/*
 * QUANTEX API - webhook receiver (PHP 8.0+)
 *
 * Put this file on your website (e.g. https://your-domain/quantex-webhook.php)
 * and add that address in Dashboard -> API -> Webhooks. QUANTEX POSTs every new
 * signal (signal.created) and its result (signal.result); this file checks the
 * signature and forwards the signal to your Telegram channel.
 *
 * Settings: write them below, or set them as environment variables.
 */
$secret = getenv('QX_WEBHOOK_SECRET') ?: 'whsec_PUT_YOUR_SECRET_HERE';   // shown once when you add the webhook
$tgToken = getenv('TG_BOT_TOKEN') ?: '';                                  // optional: post to Telegram
$tgChat = getenv('TG_CHAT') ?: '';                                        // optional, e.g. @your_channel

$raw = file_get_contents('php://input');           // the raw body: the signature is made over it

// X-Quantex-Signature: t=<unix time>,v1=<hex HMAC-SHA256 of "<t>.<raw body>">
parse_str(str_replace(',', '&', $_SERVER['HTTP_X_QUANTEX_SIGNATURE'] ?? ''), $sig);
$t = $sig['t'] ?? '';
$expected = hash_hmac('sha256', $t.'.'.$raw, $secret);
if (! ctype_digit($t) || abs(time() - (int) $t) > 300 || ! hash_equals($expected, $sig['v1'] ?? '')) {
    http_response_code(401);
    exit;
}

// Retries send the same delivery id: handle each one once.
$delivery = preg_replace('/[^A-Za-z0-9_-]/', '', $_SERVER['HTTP_X_QUANTEX_DELIVERY'] ?? '');
$seenFile = sys_get_temp_dir().'/quantex-delivery-'.$delivery;
if ($delivery === '' || file_exists($seenFile)) {
    http_response_code(200);
    exit;
}
touch($seenFile);

$event = json_decode($raw, true);
$s = $event['data'];
if ($event['type'] === 'signal.created') {
    $text = "📊 {$s['pair']} {$s['timeframe']} {$s['direction']} - entry ".substr($s['entry_at'], 11, 5)." UTC, payout {$s['payout']}%";
} elseif ($event['type'] === 'signal.result') {
    $text = "{$s['pair']} {$s['direction']}: {$s['result']}".(! empty($s['mtg_level']) ? " (MTG {$s['mtg_level']})" : '');
} else {
    $text = 'QUANTEX webhook test received ✅';         // "ping" from the Send test button
}
file_put_contents(__DIR__.'/quantex-events.log', date('c').' '.$text."\n", FILE_APPEND);

if ($tgToken && $tgChat) {
    $ch = curl_init("https://api.telegram.org/bot$tgToken/sendMessage");
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 4, CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode(['chat_id' => $tgChat, 'text' => $text])]);
    curl_exec($ch);
    curl_close($ch);
}
http_response_code(200);                            // answer 2xx within 5 seconds
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

- Key permission (scope): `account:read` · endpoint group: `account` · plans: Developer, Starter, Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `account:read` · endpoint group: `account` · plans: Developer, Starter, Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `markets:read` · endpoint group: `markets` · plans: Developer, Starter, Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `markets:read` · endpoint group: `markets` · plans: Developer, Starter, Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `payouts:read` · endpoint group: `payouts` · plans: Developer, Starter, Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `candles:read` · endpoint group: `candles` · plans: Pro, Business, Candle Basic, Candle Data API, Full Market Data API

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

- Key permission (scope): `history:read` · endpoint group: `history` · plans: Pro, Business, Full Market Data API

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

- Key permission (scope): `ticks:read` · endpoint group: `ticks` · plans: Full Market Data API

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

- Key permission (scope): `ticks:read` · endpoint group: `ticks` · plans: Full Market Data API
- Content type: `text/event-stream`

| parameter | in | type | required | description |
|---|---|---|---|---|
| `broker` | query | string | no | Broker: quotex, tradowix or binolla. One of: quotex, tradowix, binolla. Default: quotex. |
| `pairs` | query | string | yes | Up to 20 pair symbols, comma-separated. |

### `POST /v1/checker`

Check a signal list: WIN / LOSS / NO_DATA for each signal, with martingale (MTG) steps.

- Key permission (scope): `checker:run` · endpoint group: `checker` · plans: Starter, Pro, Business

JSON body:

| field | type | required | description |
|---|---|---|---|
| `broker` | string | no | quotex, tradowix or binolla (default quotex). |
| `signals` | array | no | Up to 200 objects: {"pair":"EURUSD_otc","time":"14:05","direction":"BUY","timeframe":"M1"}. Direction BUY/CALL or PUT/SELL. |
| `text` | string | no | Or paste a list in the bot format, one per line: "M1 EURUSD-OTC 14:05 CALL". |
| `mtg` | integer | no | Martingale steps 0-3 (default 1). |
| `date` | string | no | today, yesterday or YYYY-MM-DD (last 30 days). |
| `timezone` | number | no | UTC offset of the signal times in hours, e.g. 6 or -3 (default 6). |

Example `data`:

```json
{
    "broker": "quotex",
    "date": "2026-10-05",
    "timezone": 6,
    "mtg": 1,
    "results": [
        {
            "pair": "EURUSD_otc",
            "time": "14:05",
            "direction": "BUY",
            "timeframe": "M1",
            "result": "WIN",
            "mtg_level": 0,
            "payout": 87
        }
    ],
    "summary": {
        "total": 1,
        "wins": 1,
        "losses": 0,
        "no_data": 0,
        "win_rate": 100,
        "mtg_breakdown": [
            1,
            0
        ]
    },
    "rejected": []
}
```

### `GET /v1/news`

Upcoming economic events with the expected direction (bias) and the pairs to trade. The direction combines forecast vs previous, how the market reacted to past releases of the same event, the trend and AI; unclear news is skipped, and a currency / pair never gets two directions at the same minute. days=1 is the rest of today (in your timezone), 2 adds tomorrow, 3 the day after.

- Key permission (scope): `news:read` · endpoint group: `news` · plans: Developer, Starter, Pro, Business

| parameter | in | type | required | description |
|---|---|---|---|---|
| `days` | query | integer | no | 1-3 days ahead. Default: 1. |
| `impact` | query | string | no | high, medium, low or all. One of: all, high, medium, low. Default: all. |
| `currency` | query | string | no | Comma-separated currencies, e.g. USD,EUR. |
| `timezone` | query | number | no | UTC offset used for "today" (default 6). Default: 6. |

Example `data`:

```json
{
    "events": [
        {
            "time": "2026-10-05T12:30:00Z",
            "currency": "USD",
            "impact": "high",
            "title": "CPI m/m",
            "forecast": "0.4%",
            "previous": "0.2%",
            "bias": "bullish",
            "confidence": 78,
            "bias_source": "analysis",
            "factors": {
                "fundamental": 0.66,
                "history": 0.6,
                "technical": 0.21
            },
            "pairs_up": [
                "USDJPY"
            ],
            "pairs_down": [
                "EURUSD"
            ]
        }
    ],
    "skipped": 1,
    "reason": null,
    "source": "ForexFactory economic calendar + QUANTEX analysis"
}
```

### `GET /v1/signals/live`

Live signals the QUANTEX bot delivered, and their results. active = signals waiting for entry or running. events = signal.created and signal.result, oldest first; ask again with since=next_cursor (every 2-5 s) to get only new events. Without since: the latest events. A signal has its entry and expiry time (UTC), so your own bot can post it at once; its result arrives later with the same id. result: WIN (mtg_level 0 = direct, 1 = after one martingale step), LOSS (also after one martingale step) or NO_DATA.

- Key permission (scope): `signals:read` · endpoint group: `signals` · plans: Starter, Pro, Business

| parameter | in | type | required | description |
|---|---|---|---|---|
| `since` | query | integer | no | Cursor from next_cursor of the last answer. |
| `limit` | query | integer | no | Events per answer, 1-500. Default: 100. |
| `broker` | query | string | no | Broker(s), comma-separated: quotex, tradowix, binolla. Empty = all. |
| `market` | query | string | no | otc, live or all. One of: all, otc, live. Default: all. |
| `tf` | query | string | no | Timeframe(s), comma-separated, e.g. M1,M5. Empty = all. |
| `pair` | query | string | no | Pair(s), comma-separated, e.g. EURUSD_otc. Empty = all. |

Example `data`:

```json
{
    "active": [],
    "events": [
        {
            "cursor": 1042,
            "type": "signal.result",
            "created_at": "2026-10-05T10:32:09Z",
            "signal": {
                "id": "sig_3f9a1c0d2b7e4a6f8c11",
                "broker": "quotex",
                "pair": "EURUSD_otc",
                "market": "otc",
                "timeframe": "M1",
                "direction": "CALL",
                "entry_at": "2026-10-05T10:31:00Z",
                "expiry_at": "2026-10-05T10:32:00Z",
                "entry_epoch": 1791196260,
                "payout": 87,
                "confidence": 82,
                "engine": "hybrid",
                "status": "settled",
                "result": "WIN",
                "mtg_level": 0,
                "result_at": "2026-10-05T10:32:09Z"
            }
        }
    ],
    "next_cursor": 1042
}
```

### `GET /v1/signals/{id}`

One signal by id, with its result when it is known (status pending, running or settled).

- Key permission (scope): `signals:read` · endpoint group: `signals` · plans: Starter, Pro, Business

| parameter | in | type | required | description |
|---|---|---|---|---|
| `id` | path | string | yes | Signal id (sig_…). |

Example `data`:

```json
{
    "id": "sig_3f9a1c0d2b7e4a6f8c11",
    "broker": "quotex",
    "pair": "EURUSD_otc",
    "market": "otc",
    "timeframe": "M1",
    "direction": "CALL",
    "entry_at": "2026-10-05T10:31:00Z",
    "expiry_at": "2026-10-05T10:32:00Z",
    "entry_epoch": 1791196260,
    "payout": 87,
    "confidence": 82,
    "engine": "hybrid",
    "status": "settled",
    "result": "WIN",
    "mtg_level": 0,
    "result_at": "2026-10-05T10:32:09Z"
}
```

### `GET /v1/results`

Settled signals of one UTC day with a summary: wins, mtg_wins (won after one martingale step), losses, win_rate (with one martingale step) and win_rate_no_mtg. Up to 30 days back.

- Key permission (scope): `signals:read` · endpoint group: `signals` · plans: Starter, Pro, Business

| parameter | in | type | required | description |
|---|---|---|---|---|
| `date` | query | string | no | UTC day, YYYY-MM-DD (default today). |
| `limit` | query | integer | no | Signals in the list, 1-1000. Default: 500. |
| `broker` | query | string | no | Broker(s), comma-separated: quotex, tradowix, binolla. Empty = all. |
| `market` | query | string | no | otc, live or all. One of: all, otc, live. Default: all. |
| `tf` | query | string | no | Timeframe(s), comma-separated, e.g. M1,M5. Empty = all. |
| `pair` | query | string | no | Pair(s), comma-separated, e.g. EURUSD_otc. Empty = all. |

Example `data`:

```json
{
    "date": "2026-10-05",
    "summary": {
        "total": 48,
        "wins": 33,
        "mtg_wins": 9,
        "losses": 5,
        "no_data": 1,
        "win_rate": 89.36,
        "win_rate_no_mtg": 70.21
    },
    "results": [
        {
            "id": "sig_3f9a1c0d2b7e4a6f8c11",
            "broker": "quotex",
            "pair": "EURUSD_otc",
            "market": "otc",
            "timeframe": "M1",
            "direction": "CALL",
            "entry_at": "2026-10-05T10:31:00Z",
            "expiry_at": "2026-10-05T10:32:00Z",
            "entry_epoch": 1791196260,
            "payout": 87,
            "confidence": 82,
            "engine": "hybrid",
            "status": "settled",
            "result": "WIN",
            "mtg_level": 0,
            "result_at": "2026-10-05T10:32:09Z"
        }
    ]
}
```

### `POST /v1/future`

Make a future signal list with the QUANTEX future engine (the same as the bot's Future Signal): every minute of the window is back-tested on the last five days of each market. Answers 202 with a job at once; the list is usually ready in a few seconds (longer for many markets): GET /v1/jobs/{id}. Times are in the timezone you send; only times from now + 2 minutes are listed.

- Key permission (scope): `future:generate` · endpoint group: `future` · plans: Starter, Pro, Business
- Success status: 202

JSON body:

| field | type | required | description |
|---|---|---|---|
| `mode` | string | no | otc (default), live, blackout or whiteout (blackout / whiteout give times without a direction). |
| `broker` | string | no | quotex (default), tradowix or binolla. |
| `start` | string | no | From HH:MM (default 00:00), in your timezone. |
| `end` | string | no | To HH:MM (default 23:59), in your timezone. |
| `timezone` | number | no | UTC offset in hours, e.g. 6 or -3 (default 6). |
| `filter` | string | no | Martingale filter: non (default), mtg1 or mtg2 - a slot also counts as won when it wins within 1 / 2 martingale steps. |
| `direction` | string | no | call, put or both (default). Ignored for blackout / whiteout. |
| `level` | string | no | high (default, fewer and stronger signals) or medium (more signals). |
| `pairs` | array | no | Pairs to use, e.g. ["EURUSD_otc","USDJPY_otc"]. Empty = every open pair. |

Example `data`:

```json
{
    "id": "9d2c4b1e-7a3f-4c58-9e0a-2b6d8f1c3a47",
    "type": "future",
    "status": "queued",
    "created_at": "2026-10-05T10:00:00Z",
    "finished_at": null,
    "params": {
        "mode": "otc",
        "broker": "quotex",
        "start": "18:00",
        "end": "22:00",
        "timezone": 6,
        "filter": "non",
        "direction": "both",
        "level": "high",
        "pairs": []
    },
    "poll": "https://api.quantexbot.pro/v1/jobs/9d2c4b1e-7a3f-4c58-9e0a-2b6d8f1c3a47"
}
```

### `GET /v1/jobs/{id}`

State of a future list job: queued, running, done (result.signals) or failed (error). Jobs are kept 7 days.

- Key permission (scope): `future:generate` · endpoint group: `future` · plans: Starter, Pro, Business

| parameter | in | type | required | description |
|---|---|---|---|---|
| `id` | path | string | yes | Job id from POST /v1/future. |

Example `data`:

```json
{
    "id": "9d2c4b1e-7a3f-4c58-9e0a-2b6d8f1c3a47",
    "type": "future",
    "status": "done",
    "created_at": "2026-10-05T10:00:00Z",
    "finished_at": "2026-10-05T10:00:04Z",
    "params": {
        "mode": "otc",
        "timezone": 6
    },
    "result": {
        "mode": "otc",
        "broker": "quotex",
        "timezone": 6,
        "date": "2026-10-05",
        "timeframe": "M1",
        "start": "18:00",
        "end": "22:00",
        "filter": "NON-MTG",
        "direction": "BOTH",
        "level": "HIGH",
        "pairs_scanned": 41,
        "reason": null,
        "signals": [
            {
                "pair": "EURUSD_otc",
                "time": "18:05",
                "time_utc": "2026-10-05T12:05:00Z",
                "direction": "CALL"
            }
        ]
    }
}
```

### `GET /v1/stream/signals`

Server-Sent Events: every new signal.created / signal.result the moment it arrives (id = cursor). The stream closes after 5 minutes with event "reconnect"; reconnect with the Last-Event-ID header (EventSource does this by itself) so nothing is missed. At most 2 open streams per account.

- Key permission (scope): `signals:read` · endpoint group: `stream` · plans: Pro, Business
- Content type: `text/event-stream`

| parameter | in | type | required | description |
|---|---|---|---|---|
| `since` | query | integer | no | Start after this cursor (default: only new events). |
| `broker` | query | string | no | Broker(s), comma-separated: quotex, tradowix, binolla. Empty = all. |
| `market` | query | string | no | otc, live or all. One of: all, otc, live. Default: all. |
| `tf` | query | string | no | Timeframe(s), comma-separated, e.g. M1,M5. Empty = all. |
| `pair` | query | string | no | Pair(s), comma-separated, e.g. EURUSD_otc. Empty = all. |

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
| `signal_not_found` | 404 | No signal with this id. |
| `job_not_found` | 404 | No job with this id for your account. |
| `method_not_allowed` | 405 | Wrong HTTP method for this endpoint. |
| `payload_too_large` | 413 | The request body is larger than 64 KB. |
| `validation_failed` | 422 | Some parameters are invalid (error.fields lists them). |
| `rate_limited` | 429 | Too many requests this minute (Retry-After header). |
| `quota_exceeded` | 429 | The monthly quota is used up (error.resets_at). |
| `too_many_jobs` | 429 | Too many future lists in progress for this account; wait for one to finish. |
| `too_many_streams` | 429 | Too many open streams for this account. |
| `internal_error` | 500 | Server problem; quote meta.request_id to support. |
| `service_unavailable` | 503 | Market data is temporarily unavailable (Retry-After header). |
| `busy` | 503 | The data service is busy; retry in a few seconds. |

## Plans

### Signal API

| Plan | Price (USDT / 30 days) | Requests | API keys | Webhooks | What it opens |
|---|---|---|---|---|---|
| **Developer** | Free | 10 / minute · 3,000 / month | 1 | — | status, account, brokers, pairs, payouts, **economic news** |
| **Starter** | 29 | 60 / minute · 100,000 / month | 2 | — | + **signal checker**, **live signals and results**, **future signal lists** |
| **Pro** ⭐ | 79 | 300 / minute · 1,000,000 / month | 5 | 3 | + **candles** (30 days), **webhooks** and the **signal stream** (SSE) |
| **Business** | 199 | 1,000 / minute · 5,000,000 / month | 20 | 10 | + **candles** (365 days), more keys and webhooks |

### Market Data API

| Plan | Price (USDT / 30 days) | Brokers | Requests | API keys | What it opens |
|---|---|---|---|---|---|
| **Candle Basic** | 15 | 1 of your choice | unlimited | 2 | live **candles** M1–H4 (up to 2,000 per request), pairs, payouts |
| **Candle Data API** | 30 | 2 of your choice | unlimited | 3 | the same for two brokers |
| **Full Market Data API** ⭐ | 50 | all 3 | unlimited | 5 | + **historical candles** and **live ticks** (REST + stream) |

Signal API limits belong to the account (all keys together); the monthly quota resets on the 1st (UTC). You choose the broker(s) when you buy Candle Basic or Candle Data. Pay in **Dashboard → Upgrade plan** with Binance Pay, USDT TRC20 or USDT BEP20; the payment is verified automatically. Current prices: [quantexbot.pro/pricing](https://quantexbot.pro/pricing).

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
