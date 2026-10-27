<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 4 · Live Signal

[⬅ Back to the User Guide](../user-guide.md)

**Live Signal** gives you signals **inside your own chat with the bot**, with a chart and an automatic result. There are two modes: **Manual** (you pick the market, one signal now) and **Auto** (the bot keeps finding signals for you).

| | |
|---|---|
| **Plan** | All plans |
| **Daily allowance** | FREE 5 · STARTER 25 · PLUS 60 · INFINITY unlimited (shared with Live Session) |
| **Shown at the top** | `N/M SIGNALS REMAINING TODAY` |

---

## Open Live Signal

Tap **LIVE SIGNAL** (choose your broker if asked). Screen **📡 LIVE SIGNAL**:

| Button | What it does |
|---|---|
| **MANUAL SIGNAL** | One signal for a market you choose |
| **AUTO SIGNAL** | Continuous signals found by the bot |
| **Setting** | Change the **Owner Name** printed at the bottom of every signal |
| **Back** | Main menu |

---

## A · MANUAL SIGNAL

### Step 1 — Market type
| Button | What it does |
|---|---|
| **OTC MARKET** | Lists open OTC markets |
| **LIVE MARKET** | Lists open real markets |
| **Back** | Back to Live Signal |

### Step 2 — Pick a market
Every open market is listed with its **current payout**, e.g. `EUR/USD-OTC (92%)`. Use the page buttons to see more. Tap one.

- *"This market is currently closed."*: choose another.
- *"⏳ This market is cooling down for four minutes after a signal."*: the same market cannot be signalled again for 4 minutes. Choose another.

### Step 3 — Timeframe
**M1 · M2 · M3 · M5 · M10 · M15** (or **BACK**).

### Step 4 — Analysis and the signal
The bot shows **🔍 Analyzing (pair) — Scanning market data…**, runs the analyzer, and waits for the final confirmation window near the end of the current candle. You then receive the signal card:

- pair, **CALL ⬆ / PUT ⬇**, entry time, timeframe, payout, confidence, owner name, and a chart.

Open the trade at the **entry time** with the selected expiry. After the candle closes you automatically receive the **result** (WIN / LOSS / DOJI) with a chart.

> ⚠️ **One signal at a time.** Until the current signal's result arrives you see *"⚠️ Signal Pending Result — You cannot create a new signal until the previous signal's result is received."*

---

## B · AUTO SIGNAL

If Auto Signal is already running you see **🤖 Auto Signal Already Running** with **STOP AUTO SIGNAL**.

### Step 1 — Choose the engine
| Button | What it does |
|---|---|
| **STRATEGY MODE** | Uses one of the three analyzers |
| **SCANNING MODE** | Receives the shared supply/demand + trendline scanner stream |
| **BACK** | Back |

> Disabled modes show *"Strategy Mode is disabled by admin."* or *"Scanning Mode is disabled by admin."*

### Step 2 (Strategy Mode) — Analyzer
**🎯 AUTO SIGNAL — SELECT ANALYZER MODE**:

| Button | Description |
|---|---|
| **QUANTUM SCAN** | DYNAMIC MTF • STRUCTURE • PRACTICAL SIGNALS |
| **SMART FOCUS** | SMART MARKET ANALYZER • BEST QUALITY |
| **HYBRID ENGINE** | MTF • STRUCTURE • TRAP • SCORE 75+ |

Green **• RECOMMENDED** = best proven analyzer now. Red **• AVOID** = temporarily not advised. Details: [Chapter 5](05-strategies.md).

### Step 3 — Pair filter
| Button | What it does |
|---|---|
| **AVOID UNDER 80%** | Uses every open market whose payout is **80% or higher** |
| **ACTIVE ALL MARKET(S)** | Uses all open markets (OTC + Live) |
| **SELECT MANUALLY** | Opens a market list: tap markets to pick them, **Select All**, **Clear**, then **Confirm Selection (N)** |
| **ACTIVE LIVE MARKET** | Opens the list of real (non-OTC) markets to pick from, then **Confirm Selection** |
| **Back** | Back |

With nothing selected: *"⚠️ No Pairs Selected — Please select at least one pair."*

### Step 4 — Timeframe
- Strategy Mode: **M1 · M2 · M3 · M5 · M10 · M15**
- Scanning Mode: **M1 · M2 · M3 · M5** (*"Select to receive shared signals."*)

### Step 5 — Running
You see **🚀 Q-BOT AI SIGNAL SCANNER ONLINE — MARKET ANALYSIS IN PROGRESS**. The bot filters weak setups and sends you each signal as it is confirmed, then the result.

After every result you get:

| Button | What it does |
|---|---|
| **SEND PARTIAL** | Shows a summary of results so far. Inside it: **RESET PARTIAL** (start counting fresh) and **STOP PROGRAMME** (stop Auto Signal) |
| **STOP AUTO SIGNAL** | Stops after the current check (*"⏹ Auto Signal Stopping…"*) |
| **NEW SIGNAL** | Back to the Live Signal menu |

> Auto Signal stops by itself when your daily allowance is used up, and shows **Upgrade** / **BACK HOME**.

---

## C · Setting: Owner Name

**Setting** shows **⚙️ LIVE SIGNAL SETTINGS — OWNER NAME**.

1. Tap **Change owner name**.
2. Send the name you want at the bottom of each signal, e.g. `@yourusername` (or `/cancel`).
3. You see **✅ OWNER NAME UPDATED!**

---

## D · Group Live Signal (for bot owners)

Live Signal can also run **inside a Telegram group**. This is controlled by the **owner of the bot**, so it is mainly used with your own bot made in [Q-BOT STUDIO](13-qbot-studio.md):

1. Add your bot to the group as an **admin**.
2. In the group, the owner sends **`/start_live_signal`**.
3. The group menu **📡 GROUP LIVE SIGNAL** offers **MANUAL SIGNAL**, **AUTO SIGNAL**, **BROKER** (choose QUOTEX / TRADOWIX / BINOLLA), **SETTINGS** (owner name) and **BACK**.
4. Set up the mode like in sections A/B, review the summary and tap **CONFIRM & START**.
5. Control buttons in the group:

| Button | What it does |
|---|---|
| **START LIVE SIGNAL** | Starts (or shows the setup menu) |
| **SEND PARTIAL** | Posts a partial; **RESET PARTIAL** clears it |
| **SIGNAL STATUS** | Shows whether it is running and its settings |
| **STOP LIVE SIGNAL** | Stops the group signals |

If the bot is not an admin it says *"ADD THIS BOT AS A GROUP ADMIN, THEN TRY AGAIN."* Other group members cannot press the controls.

[⬅ Schedule Session](03-schedule-session.md) · [Next: Strategies ➡](05-strategies.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
