<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 3 · Schedule Session

[⬅ Back to the User Guide](../user-guide.md)

A **Schedule** starts a [Live Session](02-live-session.md) **automatically** at a start time and stops it at an end time, on the days you choose. You do not need to be online.

| | |
|---|---|
| **Plan** | STARTER, PLUS or INFINITY (paid license). FREE users see **🔒 ACCESS RESTRICTED** |
| **Times** | Your **Live Session timezone** (SETTINGS → CHANGE TIMEZONE → Live Session TZ) |
| **Daily allowance** | Scheduled sessions use the same daily signal allowance as Live Session |

---

## Open the schedule list

Tap **SCHEDULE SESSION** on the main menu.

- With no schedules: **📭 NO SCHEDULED SESSIONS YET** with **NEW SCHEDULE** and **BACK**.
- With schedules: **🗓️ YOUR SCHEDULED SESSIONS** lists each one with status (🟢 active / paused), time, days, next run and a countdown. Tap a schedule's button to open it. **NEW SCHEDULE** creates another one.

---

## Create a schedule: 4 steps + setup

### Step 1 / 4 — Start time
Send the start time in `HH:MM` 24-hour format, e.g. `09:00`.

### Step 2 / 4 — End time
Send the end time, e.g. `13:00`.

### Step 3 / 4 — Days
Tap the days to select them (selected days turn green). Tap again to unselect.

| Button | What it does |
|---|---|
| **SATURDAY … FRIDAY** | Toggle that day |
| **CONFIRM** | Saves the days and goes to Step 4. With no day selected the schedule runs **every day** |
| **BACK** | Back to the time step |

### Step 4 / 4 — Short name
Send a short name such as `Morning Session`, or:

| Button | What it does |
|---|---|
| **SKIP (USE DEFAULT)** | Uses a name like `Session 09:00 — 13:00` |
| **BACK** | Back to Step 3 |

### Confirm screen — SCHEDULE SESSION — CONFIRM

Shows name, start, end, days, channel, market, strategy, pairs and partial interval.

| Button | What it does |
|---|---|
| **CONFIGURE CHANNEL & PAIRS** (or **EDIT SETTINGS**) | Runs the Live Session setup: channel, username, emoji mode, market, market filter, mode, pairs, timeframe, chart and partial (exactly as in [Chapter 2](02-live-session.md)). After the partial step you return to this confirm screen |
| **CHANGE STRATEGY** | **🧠 SELECT SCHEDULE STRATEGY**: pick **QUANTUM SCAN**, **SMART FOCUS**, **HYBRID ENGINE** or **SCANNING MODE** (✓ marks the current one) |
| **SAVE SCHEDULE** | Saves it. You get **VIEW ALL SCHEDULES**, **NEW SCHEDULE** and **HOME** |
| **BACK** | Back to Step 4 |

> If the times are invalid or clash with another schedule, the bot tells you and offers **CHANGE TIME**.

---

## Manage a schedule (detail screen)

Tap a schedule in the list to see **🗓️ SCHEDULE DETAIL**: name, status, start/end, days, channel, emoji mode, market, strategy, pairs, partial, next run and countdown.

| Button | What it does |
|---|---|
| **STOP RUNNING SESSION NOW** | Only shown while this schedule's session is running. Stops it immediately |
| **EDIT SCHEDULE** | Re-opens the 4 steps and the confirm screen with the current values. Change anything and **SAVE SCHEDULE** |
| **PAUSE** | Keeps the schedule but it will not start until resumed |
| **RESUME** | Re-activates a paused schedule |
| **DELETE** | Deletes the schedule (*"🗑 Schedule deleted."*) with **VIEW SCHEDULES** and **HOME** |
| **BACK TO LIST** | Back to the list |

---

## What happens at run time

1. At the start time on a selected day, the session launches with the saved setup.
2. Signals, results and partials are posted to the saved channel just like a manual Live Session.
3. At the end time the session stops automatically.
4. If your license expired or the daily allowance is used up, the session does not post signals.

[⬅ Live Session](02-live-session.md) · [Next: Live Signal ➡](04-live-signal.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
