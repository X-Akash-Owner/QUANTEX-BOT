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
