<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 14 · Auto Trading

[⬅ Back to the User Guide](../user-guide.md)

**Auto Trading** turns QUANTEX into an **automated trading bot**. You connect your own broker account inside the Telegram bot, and every signal you choose is placed for you at the exact entry time. Each trade follows your amount, your money-management plan, your stop loss and your take profit. There are no emotions, just your plan.

| | |
|---|---|
| **Where** | Telegram bot → **AUTO TRADING** (next to Q-BOT STUDIO), a Mini App that opens inside Telegram |
| **Packages** | **PLUS** and **INFINITY** |
| **Brokers** | **QUOTEX**, **TRADOWIX**, **BINOLLA** |
| **Accounts** | Demo or Real; you can switch at any time |
| **Signals traded** | Signal Config (the bot finds them), Live Signal / Auto Signal, Live Session and your own future signal lists |

> [!WARNING]
> Trading involves risk. Auto Trading follows your settings exactly; it does not guarantee profit. Start on a **demo account**.

**Contents:**
- [14.1 Why auto trading?](#141-why-auto-trading)
- [14.2 Connect your broker](#142-connect-your-broker)
- [14.3 The screens](#143-the-screens)
- [14.4 Signal Config & QX Auto TF](#144-signal-config--qx-auto-tf)
- [14.5 Money-management plans](#145-money-management-plans)
- [14.6 Settings](#146-settings)
- [14.7 How a trade is placed](#147-how-a-trade-is-placed)
- [14.8 When a run ends](#148-when-a-run-ends)
- [14.9 FAQ](#149-faq)

---

## 14.1 Why auto trading?

Most losses come from the trader, not from the signal. Common mistakes are chasing a loss, doubling the amount out of fear, stopping too late, and dropping the plan after two wins.

- **No emotions.** Every signal is taken the same way, exactly as you set it.
- **Limits that hold.** When your **stop loss** or **take profit** is reached, auto trading stops by itself and you get a message, even when you are away.
- **Money management on autopilot.** A fixed amount, martingale, or a complete plan (Normal, Masaniello, Smart MM) is followed to the cent on every trade.
- **You only watch.** Follow every trade live in the dashboard, the log and the history.

---

## 14.2 Connect your broker

1. Tap **AUTO TRADING** in the bot. The first screen is **Choose your broker**: QUOTEX, TRADOWIX or BINOLLA.
2. Tap your broker and sign in with **your broker email and password**. Your phone remembers the email you used last for each broker, so next time you only type the password.
3. **QUOTEX** may email you a **PIN code** on a new device. Type it in the PIN screen; **Resend code** asks for a new one.

**Security**

- Your **password is never stored**. It is used once to sign in; only the broker's session is kept, **encrypted**.
- One broker account can be used by one QUANTEX user at a time.
- If the sign-in fails, you see the real reason: wrong password, unknown email, a 2FA / PIN request, a captcha or a network problem.
- **TRADOWIX**: the account's email must be verified and two-factor sign-in must be off.
- **Change broker** on the sign-in screen takes you back to the broker list.

**Always connected.** If the network drops, Auto Trading reconnects by itself in the background, and the dashboard shows *Reconnecting…*. Your settings and running state are kept, and **Stop trading** still works. You are asked to sign in again only if the broker really ended your session.

---

## 14.3 The screens

The bottom bar has five tabs: **Dashboard · Signals · MM · Log · Settings**. The **☰** menu (top right) holds your account, **History**, **Reset dashboard**, notifications, appearance and **Sign out**.

### Dashboard

| Part | What it shows |
|---|---|
| **Balance** | Your Demo or Real balance and the **Demo / Real** switch (Real asks you to confirm) |
| **Start trading / Stop trading** | Starts or stops auto trading at once |
| **Session** | Signals, wins, losses, profit and win rate. The counters keep running until you **sign out** or tap **Reset dashboard**. Closing the Mini App, a new START or a new day does not reset them |
| **Stop loss / Take profit** | How close the result is to your limits |
| **Next signals** | The next queued trades with entry time and countdown, or an animated *Scanning market* while Signal Config looks for a signal |
| **Finish card** | Shown when a run ends; see [14.8](#148-when-a-run-ends) |

### Signals

- **Signal Config** (first card): see [14.4](#144-signal-config--qx-auto-tf).
- **Your own list**: paste a future signal list or import a `.txt` file. Lines can be in almost any format, for example `M1 EURUSD-OTC 14:05 CALL` or `14:05 EURUSD (OTC) PUT M5`. Choose the **time zone** of the list and the **market**:

| Market | Meaning |
|---|---|
| **Auto** | OTC / Live as written in the list |
| **OTC** / **Live** | Every pair of the list is traded on that market |
| **Blackout** | At the entry, trade **against** the colour of the previous candle (green → PUT, red → CALL) |
| **Whiteout** | At the entry, trade **with** the colour of the previous candle |

**Clear** removes the list. The queue below shows every armed trade.

### MM (money management)

The three plans are described in [14.5](#145-money-management-plans). Only one plan runs at a time. When it finishes, the tab shows the **COMPLETED / ENDED** card with the plan's history and a **Create new plan** button.

### Log

A terminal-style live log of everything Auto Trading does. It shows orders and results with the **broker order ID**, plus skipped trades and the reason: payout too low, safety margin not reached, account safety, limit reached, and so on.

### History (☰ menu)

Every trade with date and time, pair, direction, **amount**, **payout**, martingale step, result, profit and **order ID**. The totals show trades, wins, losses, profit and win rate.

---

## 14.4 Signal Config & QX Auto TF

Many users do not know that signals must be running before anything can be traded. **Signal Config** solves this: turn it on and the bot runs **Auto Signal for you** while auto trading is running.

| Option | Choices |
|---|---|
| **Strategy** | Any analyzer the admin has enabled ([Strategies](05-strategies.md)) or **QX Auto TF** |
| **Timeframe** | M1 · M2 · M3 · M5 · M10 · M15 |
| **Market** | All · OTC · Live · avoid markets under 80 % payout |
| **Entry** | When the trade enters after the signal |

- Each signal uses your package's **Live Signal allowance**; the card shows *x / y left*.
- When you change the config while trading, the signal loop restarts with the new settings.
- When auto trading stops (STOP, a limit, the end of a plan or sign out), the signal loop stops too.

### QX Auto TF (auto trading only)

A strategy that picks **the market and the timeframe for you**:

1. Once a minute it checks the **10 best-paying open markets** (payout 80 %+, using your OTC / Live filter) on **M1, M2, M3, M4 and M5**.
2. For each market it keeps the timeframe with the strongest setup.
3. It trades the best market (score 70+) on its own timeframe, at the next candle of that timeframe. It does not trade a market it traded a moment ago.
4. It runs **one trade at a time**, including martingale steps, so trades never pile up.

For QX Auto TF the Timeframe and Entry options are hidden, because it chooses them itself. It sends no Telegram signal messages, only trades.

---

## 14.5 Money-management plans

Each plan card has its own switches for **safety margin** and (where allowed) **martingale**. Turning on safety always asks you to confirm first. You cannot start a second plan until the running one is stopped or finished.

### 🟢 Normal plan

A simple, fixed plan for steady small profits.

| | |
|---|---|
| **Capital** | **$100**, split into **5 cycles of $20** (your balance must be at least $100) |
| **Each cycle** | 15 trades with 7 wins needed (default, about **+$5 per cycle**), or 10 trades with 5 wins |
| **Amounts** | Calculated for every trade from the live payout (Masaniello method); the more wins you already have, the lower the risk |
| **Martingale** | None |
| **A cycle ends** | **Won** when its wins are in; **lost** when the needed wins can no longer come, or the cycle's cash falls under $1 |
| **The plan ends** | After the 5th cycle, as **target reached** (total profit) or **stop loss** (total loss) |

The **Cycle Dashboard** shows:
- the plan total;
- completed cycles (x / 5) with a progress bar;
- started, remaining and next trade;
- the current cycle's W / L table;
- a collapsible history of every finished cycle.

### 📊 Masaniello sheet

An exact stake table, as in a Masaniello Excel sheet.

| Input | Meaning |
|---|---|
| **Capital** | The money the sheet may use (up to your balance) |
| **Trades (events)** | How many trades the sheet has |
| **Expected wins** | How many of them must win |
| **Odds (quota)** | 1.5 – 2.0; stakes use this fixed value, not the market's payout |

- The running sheet shows # / Result / Stake / Return / Cash for every row, plus the next stake.
- The plan reaches its **target** when the wins are in.
- It **stops** when the remaining trades can no longer bring the wins.
- With **martingale** on, every martingale order counts as the next trade of the sheet (one row is shown).
- If the capital is too small for the broker's minimum of $1 per trade, the sheet tells you the minimum and refuses to start.

### 🧠 Smart Money Management

The Masaniello sheet **without martingale**: one order per signal, an exact stake per row, and an optional **safety margin**. This is the calmest of the three plans.

---

## 14.6 Settings

| Setting | What it does |
|---|---|
| **Account safety** | About half of the orders wait (up to 32 seconds) for a **better price than the candle open**; the rest enter at the open as usual. If no better price comes, the trade is skipped and logged. Default off; turning it on asks to confirm |
| **Trade amount** | A fixed amount in USD or a **%** of your balance |
| **Martingale (MTG)** | On/off, **steps** (0–10) and the **multiplier** for every step. A step goes right as the next candle opens |
| **Stop loss / Take profit** | Auto trading stops by itself when the result reaches −SL or +TP, and you get a message |
| **Safety margin** | Enter at a better price: a PUT waits until the price is **above** the candle's open, a CALL until it is **below**, within the first 32 seconds; otherwise the trade is skipped |
| **Safety on MTG** | Use the safety margin for martingale steps too (when off, the step goes at the open) |
| **Payout filter** | Trade only markets paying at least the % you choose (quick buttons 70–90 %) |
| **Signal sources** | **Live Signal**, **Live Session** and **Signal list**, each on or off. Only signals of the broker you are signed in to are traded, on their own timeframe |
| **Max trades at once** | How many signals may trade at the same time (empty means no limit). A martingale chain counts as one |
| **Signals per day** | Daily limit; auto trading continues the next day at 00:00 (UTC+6) |
| **Skip after a loss** | After a lost signal the bot only **watches** the next signals (no order) until one of them would have won; then it trades again |
| **Trade notifications** | A message in the bot for every result (stop loss, take profit and plan messages are always sent) |
| **Appearance** | Auto (follows Telegram), Dark or Light |

---

## 14.7 How a trade is placed

1. A signal arrives from Signal Config, Live Signal, Live Session or your list, and is queued with its entry time.
2. A few seconds before the entry, the market is prepared. The order is sent so that it reaches the broker **as the candle opens**; the broker's clock and your connection's delay are measured and taken into account.
3. **Martingale** is decided from the live price a moment before the candle closes, so the next step reaches the broker exactly at the next open. If the broker's result comes late, a step can still go while the candle is young, but **only at the open price or a better one**; otherwise it is skipped.
4. A signal counts **once**: a WIN if any of its orders won, and a LOSS only when its last order lost.
5. Results update the dashboard, the log and the history. Your limits and plan are checked after every signal.

---

## 14.8 When a run ends

When **take profit**, **stop loss** or the **end of a plan** stops auto trading:

- The **Dashboard** shows a finish card: 🏆 *Congratulations* with confetti for a profit, or a 🛡 stop-loss card. It lists the **start balance, profit, balance now** and the trades, and stays until you tap **OK** or start again.
- A finished plan switches itself off. The **MM** tab shows **COMPLETED** or **ENDED** with the plan's full trade history and a **Create new plan** button.
- The bot sends you the same summary in Telegram.

---

## 14.9 FAQ

**Is my password safe?** It is never stored. Only an encrypted broker session is kept, and you can **Sign out** at any time, which deletes the session.

**Does Auto Trading keep running when I close Telegram?** Yes. It runs on the QUANTEX server, not on your phone.

**Nothing is being traded. Why?** Check that a signal source is on. The easiest way is **Signal Config**. Then open the **Log**: every skipped trade has its reason, such as market closed, payout under your filter, safety margin not reached, max trades at once, daily limit, stop loss / take profit reached, or not connected.

**Why is my plan's first trade only $1?** The plan's capital is too small. Raise the capital, or choose fewer trades or fewer wins; the plan card shows the minimum.

**Can I use Auto Trading on Real?** Yes. Switch to **Real** on the dashboard (you confirm once). Test your settings on **Demo** first.

---

[⬅ Q-BOT STUDIO](13-qbot-studio.md) · [User Guide](../user-guide.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
