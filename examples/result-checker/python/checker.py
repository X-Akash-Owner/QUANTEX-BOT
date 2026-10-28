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
