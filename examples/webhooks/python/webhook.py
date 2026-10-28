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
