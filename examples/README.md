# 🧪 QUANTEX Developer API — code examples

Complete programs you can copy, tested against the API. Put your key in the environment variable `QX_API_KEY`
(or in the file where it says so; create the key in [Dashboard → API keys](https://quantexbot.pro/dashboard/api/keys)) and never write a key into code you share.

| Example | Language | Files |
|---|---|---|
| [Live candle chart on your website](live-chart/php/) | PHP | `index.html`, `api.php` |
| [Live candle chart on your website](live-chart/node/) | Node.js | `index.html`, `server.js` |
| [Live candle chart on your website](live-chart/python/) | Python | `index.html`, `server.py` |
| [Download historical candles to CSV](export-candles/python/) | Python | `export.py` |
| [Download historical candles to CSV](export-candles/node/) | Node.js | `export.js` |
| [Download historical candles to CSV](export-candles/php/) | PHP | `export.php` |
| [curl.md](curl.md) | shell | One request per endpoint |

- **Live candle chart** — a page with a moving candle chart (M1 to H4) and a pair list, fed by candles and live ticks. A small server file adds your key, so visitors never see it. Needs **Full Market Data API** (live ticks).
- **Download historical candles to CSV** — every closed candle of a date range for one pair, for Excel, backtests or your own database. Needs **Full Market Data API** (historical candles).

Full documentation: [../DEVELOPER_API.md](../api/README.md) · OpenAPI: [../api/openapi.json](../api/openapi.json)
