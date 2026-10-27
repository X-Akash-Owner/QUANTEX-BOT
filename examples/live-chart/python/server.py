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
