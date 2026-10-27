<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 1 · Getting Started & the Main Menu

[⬅ Back to the User Guide](../user-guide.md)

---

## 1.1 Open the bot

1. Open Telegram and search **@QuantexBinaryTools_bot**, or tap [t.me/QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot).
2. Send **`/start`**.
3. To use the bot you must be a member of our **main channel** [t.me/bdtraderpro](https://t.me/bdtraderpro). Every update, new feature and announcement is posted there first. If you are not a member you see **🔐 Access Required**:

| Button | What it does |
|---|---|
| **📢 Join Channel** | Opens the main channel ([t.me/bdtraderpro](https://t.me/bdtraderpro)). Join it. |
| **✅ Verify Membership** | Checks that you joined. If yes you see *"✅ Verified! Welcome to QUANTEX BOT!"* and the main menu opens. If not, you see *"❌ Not joined yet!"* |

> If you ever leave the channel, the bot shows **⚠️ You have left the channel!** with **📢 Rejoin Channel** and **✅ Verify Membership**. Rejoin and verify to continue.

---

## 1.2 The Main Menu: every button

The main menu is your home screen. **BACK HOME** / **HOME** on any screen brings you back here.

### Core

| Button | What it opens | Plan | Chapter |
|---|---|---|---|
| **START LIVE SESSION** | Auto signals posted to your own channel/group at every candle | STARTER+ | [2](02-live-session.md) |
| **SCHEDULE SESSION** | Run a Live Session automatically at set times and days | STARTER+ | [3](03-schedule-session.md) |
| **SETTINGS** | Timezones, templates and broker preferences | All (editing templates: PLUS+) | [10](10-settings.md) |
| **AUTO TRADING** | Trade the signals automatically on your own broker account | PLUS+ | [14](14-auto-trading.md) |

### Signal Checkers

| Button | What it opens | Plan |
|---|---|---|
| **LIVE CHECKER** | Check a Live-market signal list (WIN / LOSS / DOJI) | All |
| **OTC CHECKER** | Check an OTC signal list | All |
| **BLACKOUT CHECKER** | Check a Blackout signal list | All |
| **WHITEOUT CHECKER** | Check a Whiteout signal list | All |

→ [Chapter 7](07-checkers.md)

### Future Signals

| Button | What it opens | Plan |
|---|---|---|
| **OTC MARKET FS** | Future signal list for OTC markets | Daily limit |
| **LIVE MARKET FS** | Future signal list for Live markets | Daily limit |
| **BLACKOUT FS** | Future list for the blackout style | Daily limit |
| **WHITEOUT FS** | Future list for the whiteout style | Daily limit |
| **FUTURE LIVE** | Paste your own list and the bot posts each signal live with results | FREE: 3 sessions |
| **AXTIRON FS** | Advanced future signal generator for one chart | Daily limit |
| **AI FILTER** | Keep only the strongest signals of any future list | Paid (FREE: admin allowance) |

→ [Chapter 6](06-future-signals.md)

### Signals & Markets

| Button | What it opens | Plan |
|---|---|---|
| **LIVE SIGNAL** | Manual or Auto signals right inside the bot chat | Daily limit → [4](04-live-signal.md) |
| **BUG SIGNAL** | Shows *"Coming Soon — This feature is under development."* | — |
| **LIVE PAYOUTS** | Current payout % of every market | All → [8](08-tools.md) |
| **NEWS SIGNAL** | CALL/PUT cards from the economic calendar | Paid (FREE: admin allowance) → [8](08-tools.md) |
| **LIVE CHART** | Opens the candlestick chart app with indicators and drawing tools | All → [9](09-live-chart.md) |
| **QUANTEX HUB** | Opens the community app | All → [11](11-account.md) |
| **AI ASSISTANT** | Shows *"Coming soon"* | — |

### Tools

| Button | What it opens | Plan |
|---|---|---|
| **FORMATTER** | Convert a signal list to any format | All |
| **MARKET FILTERS** | Shows which markets are stable now | All |
| **SWAP C/P** | Shows *"🌀 SWAP C/P is coming soon — stay tuned!"* | — |
| **TZ CONVERTER** | Shift the times of a signal list to another timezone | All |

→ [Chapter 8](08-tools.md)

### Account & More

| Button | What it opens | Chapter |
|---|---|---|
| **MY PROFILE** | Your plan, expiry and remaining daily credits | [11](11-account.md) |
| **REFERRAL** | Your invite link and promo-code rewards | [11](11-account.md) |
| **UPGRADE** | Plans, prices and Auto Payment | [11](11-account.md) |
| **WEB CONTROL** | Browser-style control panel (Mini App) | [11](11-account.md) |
| **ABOUT** | About the bot, owner and channels | [11](11-account.md) |
| **REVIEWS** | Rate the bot 1–5 stars | [11](11-account.md) |
| **OTHERS** | Telegram Login, TG Status, Signal History | [11](11-account.md) |
| **FREE BOTS** | 10 free bots (01–05 open) | [12](12-free-bots.md) |
| **Q-BOT STUDIO** | Build and run your own branded bot *(released 18 Oct 2026 · FREE / LITE / PRO / ELITE)* | [13](13-qbot-studio.md) |
| **HELP** | A short how-to page inside the bot | [11](11-account.md) |

> 🛠 Admins and sub-admins also see an **ADMIN PANEL** button. Normal users do not.

---

## 1.3 Choosing your broker

QUANTEX-BOT supports **QUOTEX**, **TRADOWIX** and **BINOLLA**. Most features first show:

**🌐 SELECT YOUR BROKER**: tap **QUOTEX**, **TRADOWIX** or **BINOLLA**. The feature then continues with that broker's markets and payouts.

- If a broker is switched off by the admin you see *"This broker is currently unavailable."*
- To stop being asked every time, open **SETTINGS → PRIMARY BROKER**, pick your broker and turn **USE THIS BROKER IN ALL FEATURES** to **ON** (see [Chapter 10](10-settings.md)).

📋 The full list of markets per broker is in [SUPPORTED_MARKETS.md](../supported-markets.md).

---

## 1.4 Daily limits and "ACCESS RESTRICTED"

- When a daily allowance is used up you see a message such as **⚠️ Daily Signal Limit Reached** with **Upgrade** and **BACK HOME**. Allowances reset at **12:00 AM (midnight)**.
- Features that need a paid plan (Live Session, Schedule) show **🔒 ACCESS RESTRICTED** with your Telegram ID and these buttons:

| Button | What it does |
|---|---|
| **Owner** | Opens a chat with the owner |
| **Upgrade** | Opens the plans page |
| **Promo Code** | Lets you type a promo code to activate a license |
| **Back** | Returns to the main menu |

[Next: Live Session ➡](02-live-session.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
