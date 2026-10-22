# 14 · Auto Trading 🟢 *released 22 Oct 2026*

[← Back to the User Guide](../USER_GUIDE.md)

**Auto Trading** turns QUANTEX into an **automated trading bot**: you connect your own broker account inside the Telegram bot, and every signal you choose is placed for you at the exact entry time — with your stake, your money management, your stop loss and your take profit. No emotions, just your plan.

| | |
|---|---|
| **Where** | Telegram bot → **AUTO TRADING** (next to Q-BOT STUDIO) — a mini app that opens inside Telegram |
| **Plan** | **PLUS** and **INFINITY** packages |
| **Brokers** | **QUOTEX**, **TRADOWIX**, **BINOLLA** |
| **Accounts** | Demo or Real — you switch at any time |
| **Signals traded** | Live Signal / Auto Signal, Live Session, and your own future signal lists |

> ⚠️ Trading involves risk. Auto Trading follows your settings exactly; it does not guarantee profit. Start on a **demo account**.

---

## 14.1 Why auto trading?

Most losses come from the trader, not from the signal: chasing a loss, doubling the stake out of fear, stopping too late, skipping the plan after two wins.

- **No emotions** — every signal is taken the same way, exactly as you set it.
- **Limits that hold** — when your **stop loss** or **take profit** is reached, auto trading stops by itself and you get a message, even when you are away.
- **Money management on autopilot** — fixed stake, martingale or the **QUANTEX Recovery** plan, followed to the cent on every trade.
- **You only watch** — pick good signals, set your limits, and follow every trade live in the dashboard, the log and the history.

---

## 14.2 Connect your broker (secure sign-in)

1. Tap **AUTO TRADING** in the bot. The first screen is **Choose your broker** — QUOTEX, TRADOWIX or BINOLLA, each with its logo.
2. Tap your broker and sign in with **your broker email and password**. The email you used last for each broker is remembered on your phone, so next time you only type the password.
3. **QUOTEX** may e-mail you a **PIN code** on a new device: type it in the PIN screen (**Resend code** asks for a new one).

**Security**

- Your **password is never stored**. It is used once to sign in; only the broker's session is kept, **encrypted**.
- One broker account can be used by one QUANTEX user at a time.
- If the sign-in fails you see the real reason: wrong password, unknown email, a 2FA / PIN request, a captcha, or a network problem.
- **TRADOWIX**: the account's email must be verified and two-factor sign-in must be off.
- **Change broker** on the sign-in screen takes you back to the broker list.

**Always connected** — if the network drops, Auto Trading reconnects by itself in the background (the dashboard shows *Reconnecting…*); your settings and running state are kept, and **Stop trading** still works. You are asked to sign in again only if the broker really ended your session.

---

## 14.3 The screens

The bottom bar has five tabs: **Dashboard · Signals · MM · Log · Settings**. The **☰** menu (top right) opens **History**, **Reset dashboard** and **Sign out**.

### Dashboard

| Part | What it shows |
|---|---|
| **Balance** | Your Demo or Real balance; the **Demo / Real** switch (Real asks you to confirm) |
| **Start trading / Stop trading** | Starts or stops auto trading at once (the button reacts instantly) |
| **Stop loss / Take profit bars** | How close the result since START is to your limits |
| **Today** | Signals, wins, losses, profit and win rate of the day (UTC+6) |
| **Next signals** | The next queued trades with their entry time and a countdown |

### Signals

Load your own **future signal list** — paste it or import a `.txt` file. Lines can be in almost any format (for example `M1 EURUSD-OTC 14:05 CALL`, or `14:05 EURUSD (OTC) PUT M5`); choose the **time zone** of the list and the **market**:

| Market | Meaning |
|---|---|
| **Auto** | OTC / Live as written in the list |
| **OTC** / **Live** | Every pair of the list is traded on that market |
| **Blackout** | At the entry, trade **against** the colour of the previous candle (green → PUT, red → CALL) |
| **Whiteout** | At the entry, trade **with** the colour of the previous candle |

**Clear** removes the list. The queue below shows every armed trade.

### MM (money management)

- **Apply money management** — when on, stakes follow the plan below (martingale pauses); when off, stakes follow Settings.
- **QUANTEX Recovery** — after a lost signal, the next signal's stake wins back the losses plus a profit. Choose the number of **recovery levels**; the **money management sheet** shows the stake, total risk and result of every level.

### Log

A terminal-style live log of everything Auto Trading does: orders, results, skipped trades and the reason (payout too low, safety margin not reached, limit reached, …).

### History (☰ menu)

Every trade with date and time, pair, direction, **amount**, **payout**, martingale step, result and profit, plus the totals: trades, wins, losses, profit and win rate. **Clear** empties it.

---

## 14.4 Settings

| Setting | What it does |
|---|---|
| **Stake** | A fixed amount in USD or a **%** of your balance |
| **Martingale (MTG)** | On/off, **steps** (1–3) and **multiplier** (×1.5 · ×2 · ×2.2 · ×2.5 · ×3). A step goes right as the next candle opens |
| **Stop loss / Take profit** | Auto trading stops by itself when the result since START reaches −SL or +TP (you get a message) |
| **Safety margin** | Enter at a better price: a PUT waits until the price is **above** the candle's open, a CALL until it is **below** — within the first 32 seconds; otherwise the trade is skipped |
| **Safety on MTG** | Use the safety margin for martingale steps too (off: the step goes at the open) |
| **Payout filter** | Trade only markets paying at least the % you choose (quick buttons 70–90 %) |
| **Signal sources** | **Live Signal**, **Live Session** and **Signal list** — each on or off. Only signals of the broker you are signed in to are traded, on the timeframe they were sent with |
| **Max trades at once** | How many signals may trade at the same time (empty = no limit). Example: 5 list signals at 14:05 and a limit of 2 → the first 2 are traded, the others are skipped and logged |
| **Signals per day** | Daily limit; auto trading continues the next day at 00:00 (UTC+6) |
| **Trade notifications** | A message in the bot for every result (stop-loss / take-profit messages are always sent) |
| **Appearance** | Auto (follows Telegram), Dark or Light |

---

## 14.5 How a trade is placed

1. A signal arrives (Live Signal, Live Session or your list) → it is queued with its entry time.
2. A few seconds before the entry the market is prepared; the order is sent so that it reaches the broker **as the candle opens** (the broker's clock and your connection's delay are measured and taken into account).
3. **Martingale** is decided from the live price a moment before the candle closes, so the next step reaches the broker exactly at the next open. If the broker's result comes late, a step can still go while the candle is young — but **only at the open price or a better one** (auto safety); otherwise it is skipped.
4. A signal counts **once**: a WIN if any of its orders won, a LOSS only when its last order lost.
5. Results update the dashboard, the log and the history; your limits are checked after every signal.

---

## 14.6 FAQ

**Is my password safe?** It is never stored. Only an encrypted broker session is kept, and you can **Sign out** at any time (the session is deleted).

**Does Auto Trading keep running when I close Telegram?** Yes. It runs on the QUANTEX server, not on your phone.

**Why was a signal not traded?** Open the **Log** — every skip has its reason: market closed, payout under your filter, safety margin not reached, max trades at once, daily limit, stop loss / take profit reached, or not connected.

**Can I use Auto Trading on Real?** Yes — switch to **Real** on the dashboard (you confirm once). Test your settings on **Demo** first.

---

[← Q-BOT STUDIO](13-qbot-studio.md) · [User Guide](../USER_GUIDE.md)
