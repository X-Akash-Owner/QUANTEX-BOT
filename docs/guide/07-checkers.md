<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 7 · Signal Checkers

[⬅ Back to the User Guide](../user-guide.md)

The checkers tell you whether each signal in a list **won or lost**, using real candle data. Use them to test any signal channel or your own lists.

| | |
|---|---|
| **Plan** | All plans (FREE included) |
| **Buttons** | **LIVE CHECKER**, **OTC CHECKER**, **BLACKOUT CHECKER**, **WHITEOUT CHECKER** |
| **Timezone** | Your **Checker TZ** (change it on the input screen or in SETTINGS) |

| Checker | Use it for | Pair names |
|---|---|---|
| **OTC CHECKER** | OTC signal lists | Live names are converted to OTC automatically |
| **LIVE CHECKER** | Real-market lists | OTC names are converted to Live automatically |
| **BLACKOUT CHECKER** | Blackout lists | as written |
| **WHITEOUT CHECKER** | Whiteout lists | as written |

---

## Step 1 — Paste your signals

The screen shows examples of accepted formats, for example:

```
M1;EURUSD-OTC;14:26;CALL
M5 EURUSD-OTC 14:45 PUT
M15 EURUSD 14:45 PUT
```

Almost any format works (separators, `CALL/PUT/BUY/SELL/UP/DOWN`, `-OTC` / `_otc` / `OTC`, with or without timeframe; M1 is assumed if missing).

| Button | What it does |
|---|---|
| **CHANGE UTC** | Choose the timezone your list is written in |
| **Back** | Main menu |

## Step 2 — Martingale (MTG)

| Button | What it does |
|---|---|
| **MTG 1** | A loss followed by a win on the next candle counts as **MTG WIN** (1 step) |
| **MTG 2** | Up to 2 recovery candles |
| **NON MTG** | Only the first candle counts |
| **CUSTOM MTG** | Type any number of steps from **1 to 20** |

## Step 3 — Date

| Button | What it does |
|---|---|
| **TODAY** | Check against today's candles |
| **YESTERDAY** | Check against yesterday's candles |
| **CUSTOM DATE** | Type a date: `2026-05-15`, `2026/05/15`, `2026_05_15` or `20260515` |

## Step 4 — Payout filter

*"Signals with payout below 80% will be shown with their payout % and will not be counted as WIN or LOSS."*

| Button | What it does |
|---|---|
| **YES** | Enable the filter |
| **NO** | Count every signal |

## Step 5 — Results

A progress bar runs while candles are checked, then you get every signal marked **WIN ✅**, **MTG WIN**, **LOSS ❌** or **DOJI ⚖️**, plus totals and the win rate.

| Button | What it does |
|---|---|
| **CHECK AGAIN** | Check another list with the same checker |
| **CHECK AGAIN WITH PAYOUT FILTER** | Re-runs the same list with the payout filter on |
| **SHOW LOSS CANDLES** | Shows the candle details of the losing signals |
| **BACK HOME** | Main menu |

[⬅ Future Signals](06-future-signals.md) · [Next: Tools ➡](08-tools.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
