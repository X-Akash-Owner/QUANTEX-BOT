<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 6 · Future Signals

[⬅ Back to the User Guide](../user-guide.md)

A **future signal list** is a list of trades for later today, e.g. `M1 EURUSD-OTC 14:35 CALL`. You copy the list and take each trade at its time. QUANTEX-BOT has several generators plus tools to filter and auto-post lists.

| Feature | What it makes | Plan |
|---|---|---|
| **OTC MARKET FS** | A list for OTC markets | FREE 2 · STARTER 3 · PLUS 10 lists/day · INFINITY unlimited |
| **LIVE MARKET FS** | A list for real markets | same allowance |
| **BLACKOUT FS** | A blackout-style list | same allowance |
| **WHITEOUT FS** | A whiteout-style list | same allowance |
| **AXTIRON FS** | A premium list for one chart, 1–5 hours | STARTER 3 · PLUS 10/day · INFINITY unlimited · FREE: admin allowance |
| **AI FILTER** | Keeps only the strongest signals of any list | Paid plans · FREE: admin allowance |
| **FUTURE LIVE** | Posts your list live to a channel with results | FREE 3 sessions · paid unlimited |

All times use the timezone set in **SETTINGS → CHANGE TIMEZONE** for that feature.

---

## 6.1 OTC / LIVE / BLACKOUT / WHITEOUT FS

These four buttons work the same way. Tap one (choose broker if asked).

### Step 1 — Choose the logic
**⚙️ SELECT YOUR FUTURE SIGNAL LOGIC**

| Button | What it means |
|---|---|
| **NEW FS LOGIC** | Back-tests every chosen market's time slots on recent history and keeps the slots that won most consistently (recommended) |
| **OLD FS LOGIC** | The classic generator with System / Strategy / Quantity choices |
| **Back** | Main menu |

> If the admin paused a mode you see *"THIS FUTURE SIGNAL MODE IS TEMPORARILY UNAVAILABLE."*

### Step 2 — Start time
Send `HH:MM`, e.g. `09:00`.

### Step 3 — End time
Send `HH:MM`, e.g. `23:59`. It must be after the start time.

---

### NEW FS LOGIC — the next steps

**MARKETS**: shows the time range and how many are selected. Each market button shows its payout.

| Button | What it does |
|---|---|
| **(market)** | Tap to select / unselect |
| **SELECT ALL** / **CLEAR ALL** | Select or clear every market |
| **CONTINUE (N) →** | Next step (at least one market) |
| **Back** | Back |

**FILTER**: choose your martingale filter:

| Button | Meaning |
|---|---|
| **MTG 1 FILTER** | Slots that win directly or with 1 recovery step |
| **MTG 2 FILTER** | Allows up to 2 recovery steps |
| **NON MTG FILTER** | Only slots that win directly, without martingale |

**DIRECTION** *(OTC and Live only; Blackout/Whiteout always use both)*:

| Button | Meaning |
|---|---|
| **CALL** | Only CALL signals |
| **PUT** | Only PUT signals |
| **BOTH** | Both directions |

**FILTER LEVEL**:

| Button | Meaning |
|---|---|
| **HIGH** | Strictest: fewer, more consistent slots |
| **MEDIUM** | More signals, slightly looser |

**REVIEW**: shows time, timezone, markets, filter, direction and level.

| Button | What it does |
|---|---|
| **GENERATE** | Back-tests the market slots and creates your list (progress is shown) |
| **Back** | Back to the level step |

---

### OLD FS LOGIC — the next steps

| Step | Buttons | Meaning |
|---|---|---|
| **3 — Select System** | **Q-BOT LITE** (high accuracy) · **Q-BOT PRO** (ultra precision) · **Q-BOT ULTRA** (maximum signals) · **Q-BOT HYBRID** (best of all) | The generator engine |
| **4 — Select Strategy** | **PRECISION** (high accuracy) · **COUNTER** (reversal) · **DYNAMIC** (mixed momentum) · **ADAPTIVE** (AI-based adaptive) | The signal style |
| **5 — Signal Quantity** | **LOW** (max 15) · **MEDIUM** (max 30) · **HIGH** (based on time range) | How many signals |
| **6 — System Mood** | **MANUAL** (you pick pairs: tap pairs, **SELECT ALL**, **CLEAR ALL**, **GENERATE (N pairs)**) · **AUTO** (all open pairs, then **GENERATE SIGNALS**) | Which pairs |

---

### The result (both logics)

You receive the formatted list with its strategy line. Buttons:

| Button | What it does |
|---|---|
| **USE AI FILTER** | Sends this list straight into the [AI Filter](#63-ai-filter) |
| **Generate Again** | Starts this FS again |
| **BACK HOME** | Main menu |

---

## 6.2 AXTIRON FS — "AXTIRON FUTURE SIGNAL V2 · MODE: LUNA"

A premium generator that studies **one open chart** in depth (about 30 days of local history) and keeps only time slots that pass a **multi-timeframe back-test**.

### Step 1 — Market type
| Button | What it does |
|---|---|
| **OTC MARKET** | Shows open OTC charts |
| **LIVE MARKET** | Shows open real-market charts |
| **SETTINGS** | Opens the AXTIRON settings (below) |
| **BACK** | Broker selection / main menu |

### SETTINGS screen
Shows mode **LUNA**, your timezone and the current choices:

| Button | Choices |
|---|---|
| **SELECT TIMEFRAME • M1** | **M1 · M2 · M3 · M5 · M10 · M15** |
| **SELECT HOURS • 2H** | **1 HOUR … 5 HOURS** (how far ahead the list goes) |
| **CHANGE TIMEZONE • UTC+6** | Pick your UTC offset |
| **BACK TO MARKETS** | Back to Step 1 |

### Step 2 — Pick a chart
*"Open charts: N — Tap a market to generate its future signals."* Use the page buttons for more. If none are open: **⚠️ NO OPEN CHART AVAILABLE** with **TRY AGAIN**.

### Step 3 — Your list
**PREMIUM FUTURE BY AXTIRON · VERSION 2 | MODE: LUNA**, then lines such as
`🚨 M1 EURUSD OTC 14:35 CALL`.

| Button | What it does |
|---|---|
| **GENERATE AGAIN** | Back to market selection |
| **BACK HOME** | Main menu |

Possible messages: *"NO STABLE FUTURE SLOT PASSED THE MULTI-TIMEFRAME BACKTEST"* (try later or another market), *"This chart is no longer open."*, or **⚠️ Daily AXTIRON FS Limit Reached** (with **BACK TO MARKETS** / **UPGRADE**).

---

## 6.3 AI FILTER

Paste **any** future list (from QUANTEX or elsewhere). The AI back-tests each line on 1–30 days of history and keeps only the strongest.

| Step | What you do | Buttons |
|---|---|---|
| **1 — Type** | Choose the kind of list | **OTC FUTURE SIGNAL FILTER** · **LIVE FUTURE SIGNAL FILTER** · **BLACKOUT SIGNAL FILTER** · **WHITEOUT SIGNAL FILTER** · **BACK HOME** |
| **2 — Paste** | Paste your list (any format) | **CHANGE UTC** (timezone of your list) · **Back** |
| **3 — History** | Choose how much history to test | **1–7 DAYS** · **7–15 DAYS** · **15–30 DAYS** |
| **4 — Confirm** | *"N SIGNALS READY · HISTORY: x–y DAYS"* | **CONFIRM FILTER** · **CHANGE DAYS** |
| **5 — Result** | Progress (BACKTEST • HISTORY • STABILITY), then the filtered list | **FILTER ANOTHER** · **MAIN MENU** |

> From an FS result, **USE AI FILTER** skips Steps 1–2.

---

## 6.4 FUTURE LIVE

Paste your own list and the bot **posts every signal to your channel at its exact time**, then posts the result automatically.

| Step | What you do | Buttons |
|---|---|---|
| **1 / 4 — Paste list** | Paste your list. All formats work, e.g. `05:50 USDIDR OTC PUT`, `USDCAD-OTC 05:53 PUT`, `M1 EURUSD_OTC 06:00 BUY`. FREE users see `N/3 sessions remaining` | **CHANGE SIGNAL TZ** · **Back** |
| **2 / 4 — Channel** | Send the channel Chat ID or forward a post. The bot must be an admin there | **Continue** (after *"✅ Channel verified!"*) · **Try Again** |
| **3 — Martingale** | Choose how results are counted | **MTG 1** · **MTG 2** · **NON MTG** |
| **3 — Payout filter** | Only signals with payout ≥ your minimum are posted | **75% · 80% · 85% · 88% · 90% · 92%** · **⏭ Skip Filter** |
| **4 — Template** | Choose the message style | **👑 QUANTEX CLASSIC** · **⚡ FLASH ALERT** · **💎 PRO TRADER** · **🌙 DARK PREMIUM** · **🎯 PRECISION** · **🚀 VIP EXCLUSIVE** |
| **5 — Preview** | See a sample message | **✅ Start Session** · **✏️ Customize Template** · **🎨 Change Template** · **Back** |

**✏️ Customize Template** (paid plans): **Change Header** (e.g. replace `👑 QUANTEX-BOT(FUTURE) 👑`), **Change Username** (your channel name without @), then **Save & Continue**. FREE users see *"Custom header and username require a license"* with **Upgrade** / **Continue Default**.

### While it runs
*"✅ Future Live Session Started! N signal(s) loaded."*

| Button | What it does |
|---|---|
| **View Signals** | Lists the remaining signals. Each has **🗑 Remove #n** to delete it |
| **Stop Session** | Stops posting (*"🛑 Future Live session stopped."*) |
| **GO HOME** | Main menu (the session keeps running) |

- Signals whose time has passed are skipped (*"All signals have already passed for today"* if none are left).
- **Safety:** after **3 losses in a row** the session pauses automatically (*"⏸ Session Auto-Paused"*).
- When the list is finished: *"✅ All signals processed! Session complete."*

[⬅ Strategies](05-strategies.md) · [Next: Signal Checkers ➡](07-checkers.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
