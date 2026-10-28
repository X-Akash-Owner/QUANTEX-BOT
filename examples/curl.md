# cURL — one request per endpoint

Replace `qx_live_YOUR_KEY` with your key. Every answer is `{"ok", "data" | "error", "meta"}`.

```bash
KEY="qx_live_YOUR_KEY"
API="https://api.quantexbot.pro/v1"

# Status (no key)
curl "$API/status"

# Your plan, limits and usage
curl "$API/account" -H "Authorization: Bearer $KEY"
curl "$API/usage?days=7" -H "Authorization: Bearer $KEY"

# Brokers, pairs and payouts
curl "$API/brokers" -H "Authorization: Bearer $KEY"
curl "$API/pairs?broker=quotex&market=otc&open=true" -H "Authorization: Bearer $KEY"
curl "$API/payouts?broker=quotex&market=otc&min=85" -H "Authorization: Bearer $KEY"

# Candles: the latest 100 M1 candles, or a whole UTC day (1440 M1 candles)
curl "$API/candles?broker=quotex&pair=EURUSD_otc&tf=M1&limit=100" -H "Authorization: Bearer $KEY"
curl "$API/candles?broker=quotex&pair=EURUSD_otc&tf=M1&date=2026-10-20" -H "Authorization: Bearer $KEY"

# Historical candles of a range of days (Full Market Data API)
curl "$API/history?broker=quotex&pair=EURUSD_otc&tf=M5&from=2026-10-01&to=2026-10-07" -H "Authorization: Bearer $KEY"

# Live ticks (Full Market Data API; QUOTEX, TRADOWIX and BINOLLA)
curl "$API/ticks?broker=quotex&pairs=EURUSD_otc,BTCUSD_otc" -H "Authorization: Bearer $KEY"
curl -N "$API/stream/ticks?broker=quotex&pairs=EURUSD_otc" -H "Authorization: Bearer $KEY"

# Signal checker: WIN / LOSS / NO_DATA with one martingale step (Starter and higher)
curl -X POST "$API/checker" -H "Authorization: Bearer $KEY" -H "Content-Type: application/json" \
  -d '{"broker":"quotex","date":"today","timezone":6,"mtg":1,"text":"M1 EURUSD-OTC 14:05 CALL\nM1 USDJPY-OTC 14:20 PUT"}'

# Economic news with the expected direction (every plan)
curl "$API/news?days=1&impact=high" -H "Authorization: Bearer $KEY"

# Live signals and results: poll every 2-5 s with since=<next_cursor> (Starter and higher)
curl "$API/signals/live?broker=quotex&tf=M1" -H "Authorization: Bearer $KEY"
curl "$API/signals/live?since=1042" -H "Authorization: Bearer $KEY"
curl "$API/signals/sig_3f9a1c0d2b7e4a6f8c11" -H "Authorization: Bearer $KEY"
curl "$API/results?date=2026-10-28" -H "Authorization: Bearer $KEY"

# Future signal list: start a job, then read it (Starter and higher)
curl -X POST "$API/future" -H "Authorization: Bearer $KEY" -H "Content-Type: application/json" \
  -d '{"mode":"otc","broker":"quotex","start":"18:00","end":"22:00","timezone":6}'
curl "$API/jobs/JOB_ID" -H "Authorization: Bearer $KEY"

# Signal stream: every new signal and result at once (Pro and Business)
curl -N "$API/stream/signals" -H "Authorization: Bearer $KEY"

# OpenAPI 3.1 (no key)
curl "$API/openapi.json"
```
