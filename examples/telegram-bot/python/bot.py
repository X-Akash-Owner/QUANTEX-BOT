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
