<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 2 · Live Session

[⬅ Back to the User Guide](../user-guide.md)

A **Live Session** scans the markets you choose and posts **signals and results automatically to your own Telegram channel or group** until you stop it. It is the main "signal channel" feature of QUANTEX-BOT.

| | |
|---|---|
| **Plan** | STARTER, PLUS or INFINITY (a paid license). FREE users see **🔒 ACCESS RESTRICTED** |
| **Daily allowance** | Shared with Live Signal: STARTER 25 · PLUS 60 · INFINITY unlimited signals per day |
| **Where signals go** | Your channel or group (the bot or your own Telegram account posts there) |
| **Steps** | Broker → 8 setup steps → Review → Launch |

---

## Before you start

1. Create a Telegram **channel** (or group) for your signals.
2. Open the channel → **Manage Channel → Administrators → Add Admin** → search **@QuantexBinaryTools_bot** → add it with permission to post messages.
   *(Not needed if you will use Premium Emoji Mode, which posts from your own Telegram account.)*
3. Decide the username you want printed on every signal (for example `@YourChannel`).

---

## Step 0 — Tap **START LIVE SESSION**

The bot checks three things:

| Check | If it fails |
|---|---|
| You have a paid license | **🔒 ACCESS RESTRICTED** screen (Owner / Upgrade / Promo Code / Back) |
| You still have signals left today | **⚠️ Daily Signal Limit Reached** with **Upgrade** and **BACK HOME** |
| A session is already running | You get the running-session controls instead of a new wizard |

### "Welcome back" screen (only if you ran a session before)

The bot shows your last setup (channel, username, broker, market, number of pairs, strategy, timeframe):

| Button | What it does |
|---|---|
| **RUN WITH PREVIOUS SETUP** | Skips all steps and goes straight to **REVIEW & CONFIRM** with your last settings |
| **START NEW SESSION** | Starts the wizard from Step 1 |
| **BACK** | Returns to the main menu |

### Broker

**🌐 SELECT YOUR BROKER** → tap **QUOTEX**, **TRADOWIX** or **BINOLLA**.
This screen is skipped if you set a Primary Broker with "use in all features" ON.

---

## Step 1 / 8 — TARGET CHANNEL

The bot asks where to post. Do **one** of these:

- **Forward any post** from your channel to the bot, **or**
- **Send the channel Chat ID** as a number, for example `-1001234567890`.

The bot then checks whether it is an admin there:

| Result | Buttons | What they do |
|---|---|---|
| **✅ CHANNEL CONNECTED!** (bot is admin) | **CONTINUE** | Goes to Step 2 |
| **⚠️ CHANNEL ACCESS WARNING** (bot cannot post) | **Continue Anyway** | Keeps this channel. Use this only if you will choose **Premium Emoji Mode** in Step 3 |
| | **Re-enter Chat ID** | Lets you send a different Chat ID or forward again |

> Invalid text (not a number and not a forwarded post) gives *"❌ Invalid input…"*. Just try again.

---

## Step 2 / 8 — USERNAME TAG

This username is printed at the bottom of **every signal and result**.

If you used a username before:

| Button | What it does |
|---|---|
| **USE SAVED USERNAME** | Keeps your previous username and goes to Step 3 |
| **CHANGE USERNAME** | Asks you to type a new one |

When typing a new one:

- Send the username, e.g. `@X_Akash_Owner` (the `@` is added automatically if you forget it), **or**
- Tap **USE MY PROFILE USERNAME** to use your own Telegram @username. (If your profile has none, the bot asks you to type one.)

---

## Step 3 / 8 — MESSAGE STYLE

| Button | What it means | Requirements |
|---|---|---|
| **PREMIUM EMOJI MODE** | Signals are posted **from your own Telegram account** with animated premium emojis. The bot does not need to be an admin of the channel. | Paid license **and** a connected Telegram account (**OTHERS → Login**) |
| **NORMAL EMOJI MODE** | Signals are posted **by the bot** with normal emojis | The bot must be an **admin** of the channel |
| **BACK** | Back to Step 2 | |

What can happen:

- Premium without a license: *"🔒 Premium Emoji Mode is only available for licensed users!"*
- Premium without a connected account: you get **Login** (connect now), **Re-check Status**, **NORMAL EMOJI MODE** and **BACK**.
- Normal mode when the bot is not admin: **⚠️ NORMAL MODE — BOT NOT ADMIN**, with:

| Button | What it does |
|---|---|
| **I've Fixed It — Continue** | Re-checks. Continues if the bot is now an admin, otherwise *"Bot is still not admin."* |
| **PREMIUM EMOJI MODE** | Switches to Premium mode instead |
| **BACK** | Back to Step 2 |

---

## Step 4 / 8 — MARKET TYPE

| Button | Markets used |
|---|---|
| **OTC MARKET** | Only OTC markets (24/7) |
| **LIVE MARKET** | Only real markets (weekdays) |
| **ALL MARKET** | Both OTC and Live |
| **BACK** | Back to Step 3 |

### Market filter (right after Step 4)

| Button | What it does |
|---|---|
| **AVOID UNDER 80%** | Uses **every open market with payout ≥ 80%** automatically. No manual pair picking. If none are open: *"No open market currently has 80% or higher payout."* |
| **SELECT MANUALLY** | You will pick the pairs yourself in Step 5 |
| **BACK** | Back to Step 4 |

### Session mode (engine)

| Button | What it does |
|---|---|
| **STRATEGY MODE** | Opens the analyzer list (below) |
| **SCANNING MODE** | Opens the scanner screen (below) |
| **BACK** | Back to the market filter |

**If you chose STRATEGY MODE**, tap an analyzer:

| Button | Short description shown |
|---|---|
| **QUANTUM SCAN** | DYNAMIC MTF • STRUCTURE • PRACTICAL SIGNALS |
| **SMART FOCUS** | SMART MARKET ANALYZER • BEST QUALITY |
| **HYBRID ENGINE** | MTF • STRUCTURE • TRAP • SCORE 75+ |

- A green button marked **• RECOMMENDED** is the analyzer with the best proven results right now.
- A red button marked **• AVOID** is temporarily not advised.
- An analyzer switched off by the admin is hidden or shows *"This strategy is currently disabled by admin."*

How each analyzer works is explained in [Chapter 5](05-strategies.md).

**If you chose SCANNING MODE**, you see **📡 SCANNING MODE**: *"Each eligible market is tracked live."* Tap **SELECT SCANNING MODE** to confirm, or **BACK**.

> If the admin has turned a whole mode off you see *"Strategy Mode is disabled by admin."* or *"Scanning Mode is disabled by admin."*

---

## Step 5 / 8 — TRADING PAIRS

*(Skipped when you chose **AVOID UNDER 80%**.)*

A grid of markets with their payout is shown, several pages long.

| Button | What it does |
|---|---|
| **(a pair name)** | Tap to select ✅ / unselect it |
| **(pair) OFF** | This pair is disabled by the admin and cannot be selected |
| **Select All** | Selects every available pair |
| **Clear All** | Unselects everything |
| **◀ PREVIOUS / NEXT ▶** | Moves between pages (the middle button shows e.g. `2/4`) |
| **My Lists** | Opens your saved favourite lists: tap a list to load it, or **Delete** to remove it |
| **Save as Favorite List** | Saves the current selection. Type a name, e.g. `My OTC Top` |
| **Confirm Selection** | Confirms and goes to Step 6. You must select at least one pair |
| **BACK TO MARKET** | Back to Step 4 |

---

## Step 6 / 8 — TIMEFRAME

| Mode | Buttons |
|---|---|
| Strategy Mode | **M1 · M2 · M3 · M5 · M10 · M15** |
| Scanning Mode | **M1 · M2 · M3 · M5** (Scanning Mode supports only these) |

M1 is the default. The timeframe is used for analysis, entry, expiry, results and charts.

---

## Step 7 / 8 — CHART SCREENSHOTS

| Button | What it does |
|---|---|
| **BOTH CHART** | Chart image on every signal **and** every result |
| **SIGNAL CHART ONLY** | Chart only on signals |
| **RESULT CHART ONLY** | Chart only on results |
| **WITHOUT CHART** | Text only (fastest) |
| **BACK TO PAIRS** | Back to Step 5 |

---

## Step 8 / 8 — PARTIAL REPORT TIMING

| Button | What it does |
|---|---|
| **Every 30 min** | Posts a results summary to your channel every 30 minutes |
| **Every 60 min** | Every hour |
| **Every 120 min** | Every 2 hours |
| **Disabled** | No automatic partials (you can still send one by hand) |
| **BACK TO CHART** | Back to Step 7 |

---

## REVIEW & CONFIRM

Shows Target, Username, Emoji Mode, Market, Pairs, Strategy, Timeframe, Chart and Partial.

| Button | What it does |
|---|---|
| **LAUNCH SESSION** | Starts the session now |
| **RECONFIGURE** | Starts the wizard again from the beginning |
| **BACK TO PARTIAL** | Back to Step 8 |

Your setup is saved, so next time you can use **RUN WITH PREVIOUS SETUP**.

---

## While the session is running

The bot analyses your pairs continuously. Large pair lists are scanned in rotating batches. When a setup passes all checks:

1. A **signal** is posted to your channel: pair, direction (CALL/PUT), entry time, timeframe, payout, confidence, your username and, if enabled, a chart.
2. After the trade candle closes, the **result** is posted (WIN, LOSS or DOJI), with a chart if enabled.
3. Partial summaries are posted at your chosen interval.

### Control buttons (in your bot chat)

| Button | What it does |
|---|---|
| **Send Partial Now** | Posts a partial summary to the channel immediately |
| **Session Status** | Shows the current stats (signals, wins, losses, win rate, running time) |
| **Edit Pairs** | Opens the pair grid. Change your selection and tap **Confirm Selection**: *"✅ Pairs Updated! Now tracking N pair(s)."* The session keeps running |
| **Pause Session** | Temporarily blocks new signals. Stats are kept |
| **View Log** | Opens the live **Session Log** web page: every market checked, every signal and why setups were accepted or rejected |
| **Stop Session** | Ends the session and shows the final summary |

When paused, **Pause Session** becomes **Resume Session** (*"▶️ Session Resumed — Signals are active again!"*).

After stopping you get **START LIVE SESSION** and **BACK HOME**.

---

## Tips

- Use **AVOID UNDER 80%** to automatically trade only high-payout markets.
- Choose the analyzer marked **RECOMMENDED** if you are unsure.
- If signals stop, check: daily allowance (MY PROFILE), the bot is still channel admin (Normal mode), your Telegram login is still valid (Premium mode; you get **🔒 Telegram Session Expired** with **Login Again** if it expired, and the session continues in Normal mode).
- Only signals actually delivered count toward your daily allowance.

[⬅ Main Menu](01-main-menu.md) · [Next: Schedule Session ➡](03-schedule-session.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
