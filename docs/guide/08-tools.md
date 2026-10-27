<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 8 · Tools, News & Payouts

[⬅ Back to the User Guide](../user-guide.md)

| Tool | Plan |
|---|---|
| **NEWS SIGNAL** | Paid plans · FREE: admin allowance per day |
| **FORMATTER** | All |
| **TZ CONVERTER** | All |
| **MARKET FILTERS** | All |
| **LIVE PAYOUTS** | All |
| **SWAP C/P** | Coming soon |
| **BUG SIGNAL** · **AI ASSISTANT** | Coming soon |

---

## 8.1 NEWS SIGNAL

Creates CALL/PUT cards for upcoming **economic-calendar events** (global news) on 29 major pairs, analysed by **QUANTEX AI**.

Home screen **📰 QUANTEX NEWS SIGNAL**:

| Button | What it does |
|---|---|
| **PAIRS (N)** | Opens the pair picker. 29 pairs: EUR/USD, GBP/USD, USD/JPY, USD/CHF, AUD/USD, USD/CAD, NZD/USD, all EUR/GBP/AUD/NZD/CAD/CHF crosses and XAU/USD (gold). Tap to toggle, **Select All**, **Clear**, **Confirm**, **Back** |
| **DAYS : 1** | How many upcoming days to analyse: **1 Day · 2 Days · 3 Days** (max 3) |
| **IMPACT : HIGH** | Which news to include: **ALL IMPACT · HIGH · MEDIUM · LOW** |
| **QUANTEX AI : ON / OFF** | ON = AI adds direction bias and a confidence score to each event; OFF = calendar-based cards only |
| **GENERATE NEWS SIGNALS** | Builds the cards |
| **Back** | Main menu |

The default selection is the 7 majors, 1 day, HIGH impact, AI ON.

Each card shows the event, time, currency, impact, the suggested CALL/PUT and the confidence. Buttons after the result: **Generate Again**, **News Menu**, **Back Home**.
*"⚠️ NEWS SIGNAL daily limit reached."* means today's allowance is used.

---

## 8.2 FORMATTER

Converts a signal list into **any format you like**.

| Step | What you do | Buttons |
|---|---|---|
| **1 / 2 — Paste list** | Paste signals in any format, e.g. `M1;EURUSD-OTC;14:26;CALL`, `M1 EURUSD_OTC 14:42 PUT`, `EUR/USD-OTC 15:10 BUY` | **Back** |
| **2 / 2 — Output format** | Send **one example line** written the way you want, e.g. `❒ USDCOP_otc 1M - 00:12 PUT`. The bot converts the whole list to match | **Paste List Again** · **Back** |
| **Result** | **🗂 FORMATTED SIGNALS** with your format and count | **Change Format** · **Paste New List** · **Back Home** |

If your example cannot be understood: *"❌ Could not convert that format"* with **Try Again**. Type `/cancel` to stop.

---

## 8.3 TZ CONVERTER

Moves all the times in a list to another timezone.

| Step | What you do |
|---|---|
| **1 / 3** | Pick the **source** timezone (the one your list is written in) |
| **2 / 3** | Pick the **target** timezone |
| **3 / 3** | Paste the list (any format) |

Result: **🕐 Timezone Converted**, showing From, To and the shift (e.g. `+2h`), then the converted list. Buttons: **Convert Another**, **Back**.

---

## 8.4 MARKET FILTERS

Shows which markets are **stable right now** (good conditions to analyse with your own setup).

| Button | What it does |
|---|---|
| **OTC MARKET** | Scans OTC markets. Pairs with payout **below 70% are excluded** |
| **LIVE MARKET** | Scans real markets |
| **Back** | Main menu |

Each stable market is listed as: `🟢 EURUSD-OTC 92%` with its **trend** (↑/↓), **RSI** and **Momentum %**.
Buttons: **Rescan** (scan again), **Switch Market**, **Back**.

---

## 8.5 LIVE PAYOUTS

Shows the **current payout %** of every OTC and Live market for your broker. Tap **Refresh** for new numbers, **Back** to return.

---

## 8.6 Coming soon

| Button | What you see now |
|---|---|
| **SWAP C/P** | *"🌀 SWAP C/P is coming soon — stay tuned! 🚀"* |
| **BUG SIGNAL** | *"Coming Soon — This feature is under development."* |
| **AI ASSISTANT** | *"Coming soon — ask trading questions in plain language…"* |

[⬅ Signal Checkers](07-checkers.md) · [Next: Live Chart ➡](09-live-chart.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
