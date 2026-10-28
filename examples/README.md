# 🧪 QUANTEX Developer API — code examples

Complete programs you can copy, tested against the API. Put your key in the environment variable `QX_API_KEY`
(or in the file where it says so; create the key in [Dashboard → API keys](https://quantexbot.pro/dashboard/api/keys)) and never write a key into code you share.

| Example | Language | Files |
|---|---|---|
| [Telegram bot: checker, live signals, candles, news](telegram-bot/python/) | Python | `bot.py` |
| [Telegram bot: checker, live signals, candles, news](telegram-bot/node/) | Node.js | `bot.js` |
| [Telegram bot: checker, live signals, candles, news](telegram-bot/php/) | PHP | `bot.php` |
| [Live candle chart on your website](live-chart/php/) | PHP | `index.html`, `api.php` |
| [Live candle chart on your website](live-chart/node/) | Node.js | `index.html`, `server.js` |
| [Live candle chart on your website](live-chart/python/) | Python | `index.html`, `server.py` |
| [Result checker from a file](result-checker/python/) | Python | `checker.py`, `signals.txt` |
| [Result checker from a file](result-checker/node/) | Node.js | `checker.js`, `signals.txt` |
| [Result checker from a file](result-checker/php/) | PHP | `checker.php`, `signals.txt` |
| [Download historical candles to CSV](export-candles/python/) | Python | `export.py` |
| [Download historical candles to CSV](export-candles/node/) | Node.js | `export.js` |
| [Download historical candles to CSV](export-candles/php/) | PHP | `export.php` |
| [Receive signals with webhooks](webhooks/python/) | Python | `webhook.py` |
| [Receive signals with webhooks](webhooks/node/) | Node.js | `webhook.js` |
| [Receive signals with webhooks](webhooks/php/) | PHP | `webhook.php` |
| [curl.md](curl.md) | shell | One request per endpoint |

- **Telegram bot** — one bot with every API tool: best payouts, live price, candles, the result checker, today's results, high-impact news, future lists, and live QUANTEX signals posted to your chat with their WIN / LOSS as a reply. Needs **Starter** or higher (candles: **Pro**).
- **Live candle chart** — a page with a moving candle chart (M1 to H4) and a pair list, fed by candles and live ticks. A small server file adds your key, so visitors never see it. Needs **Full Market Data API** (live ticks).
- **Result checker** — write your signals in `signals.txt` and get WIN / LOSS / NO DATA with martingale, the win rate and a `results.csv`. Needs **Starter** or higher.
- **Download historical candles to CSV** — every closed candle of a date range for one pair, for Excel, backtests or your own database. Needs **Full Market Data API** (historical candles).
- **Webhook receiver** — QUANTEX sends each new signal and its result to your server; the receiver checks the signature, ignores repeats and forwards the signal to Telegram. Needs **Pro** or **Business**.

Full documentation: [api/README.md](../api/README.md) · OpenAPI: [api/openapi.json](../api/openapi.json)
