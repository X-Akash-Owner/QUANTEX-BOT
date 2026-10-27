<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 13 · Q-BOT STUDIO — Build & Run Your Own Signal Bot (A → Z)

[⬅ Back to the User Guide](../user-guide.md) · [🚀 Studio release notes](../studio.md) · [💰 Studio pricing](../pricing.md#-q-bot-studio-packages)

> 🟢 **Released: 18 October 2026 · Q-BOT STUDIO v1.0 is public.**

**Q-BOT STUDIO** lets you build **your own branded Telegram signal bot** that runs on the QUANTEX engine. You don't need to write code, rent a server or host anything. You bring a bot token from @BotFather, answer **9 short steps** and tap **DEPLOY**. Your bot then runs 24/7 with your brand name, your messages, your buttons, your strategy and your own admin panel.

This chapter is the complete manual. It covers every screen, every step, every button and what happens after each tap.

---

## Contents

1. [What you get](#131-what-you-get)
2. [Packages at a glance](#132-packages-at-a-glance)
3. [Studio home](#133-studio-home)
4. [SUBSCRIBE — buy, renew or upgrade](#134-subscribe--buy-renew-or-upgrade)
5. [Before you start: get a bot token](#135-before-you-start-get-a-bot-token)
6. [CREATE — the 9 steps](#136-create--the-9-steps)
7. [REVIEW & DEPLOY](#137-review--deploy)
8. [MY BOTS — manage a bot](#138-my-bots--manage-a-bot)
9. [CUSTOMIZE — every option](#139-customize--every-option)
10. [STUDIO CONTROL — the web app](#1310-studio-control--the-web-app)
11. [Strategies for your bot](#1311-strategies-for-your-bot)
12. [Your bot's ADMIN PANEL](#1312-your-bots-admin-panel)
13. [Run-time rules: FREE, INFINITY, reminders](#1313-run-time-rules-free-infinity-reminders)
14. [Privacy & isolation](#1314-privacy--isolation)
15. [Troubleshooting](#1315-troubleshooting)

---

## 13.1 What you get

| | |
|---|---|
| 🏷 **Your brand everywhere** | Your brand name replaces "QUANTEX" in menus, welcome text, signal and result cards, chart titles, watermarks and partial reports, in the same font style |
| 🧩 **Your features** | Choose which QUANTEX features become buttons in your bot (up to 23) |
| 🧠 **Your strategy** | Offer the main bot's analyzers, or pick ready-made strategies, trading styles, your own indicator mix or a 20-indicator builder with editable values *(depends on the package)* |
| 🎨 **Your look** | 5 Welcome, 5 About and 5 Help templates. 3 chart templates. 3 Live Signal and 3 Live Result templates. Button names, colours, fonts, premium emojis and a drag-and-drop button layout |
| 🏦 **Your brokers** | QUOTEX, TRADOWIX and BINOLLA *(depends on the package)* |
| 🕐 **Your timezone** | Every time in your bot (signals, sessions, checkers, future lists, charts) uses your bot's timezone |
| 🔐 **Force Join** | Users must join your channel before using the bot |
| 🛠 **Your admin panel** | `/admin` inside your bot: users, licences, broadcast, bans, stats, logs, access mode, plus a full **Admin Web** |
| 📊 **Analytics** | Users, active today, actions and signals per bot |
| ⚡ **No hosting** | Your bot runs on the QUANTEX engine. Start, stop, change the token or delete it at any time |

---

## 13.2 Packages at a glance

| | 🆓 **FREE** | 👑 **INFINITY** | 🟢 **LITE** | 🔵 **PRO** | 👑 **ELITE** |
|---|---|---|---|---|---|
| **Price / month** | $0 | Included with the main-bot INFINITY plan | **$30** | **$55** | **$80** |
| **Price / year** | — | — | **$300** | **$550** | **$800** |
| **Bots** | 1 | 1 | 1 | 3 | 5 |
| **Brokers** | QUOTEX | QUOTEX | QUOTEX | Any 2 | All 3 |
| **Features** | 2 | 9 | 14 | 20 | All 23 |
| **Strategy** | Main bot | Main bot | + 10 pre-made | + 7 styles + custom mix | Everything + 20-indicator builder + 2 named strategies |
| **Main-bot analyzers** | 1 | 1 | 2 | 3 | All 5 |
| **Message & chart templates** | TEMPLATE 01 | TEMPLATE 01 | TEMPLATE 01 | All | All |
| **Run time** | 7 days every 30 days, 4h on / 2h off | 6h on / 2h off (18h a day) | 24/7 | 24/7 | 24/7 |

Full details, each package's feature list and how to pay are in **[13.4 SUBSCRIBE](#134-subscribe--buy-renew-or-upgrade)** and [PRICING.md](../pricing.md#-q-bot-studio-packages).

---

## 13.3 Studio home

Main menu → **Q-BOT STUDIO**. The home screen shows **SYSTEM STATUS**: bots used / your limit, running bots, your package and your access level.

| Button | What it does |
|---|---|
| **CREATE** | Starts the 9-step wizard ([13.6](#136-create--the-9-steps)) |
| **MYBOTS** | Your bots (🟢 running / 🔴 stopped). Tap one to manage it ([13.8](#138-my-bots--manage-a-bot)) |
| **ANALYTICS** | Users, active today and actions today / total for each bot, with **PREV / NEXT** between bots |
| **SUBSCRIBE** | Your Studio package, validity, bots used, and the package list to buy or renew ([13.4](#134-subscribe--buy-renew-or-upgrade)) |
| **HELP** | Short Studio help inside Telegram |
| **Back** | Main menu |

> ⚠️ **UNDER MAINTENANCE**: if the admin pauses the Studio, you see this banner and creating is paused until it comes back. Running bots are not affected.
>
> 🔒 **BOT LIMIT REACHED**: when you already have as many bots as your package allows, **CREATE** shows your package and limit with **SUBSCRIBE** and **MYBOTS**. Upgrade or delete a bot to build a new one.

---

## 13.4 SUBSCRIBE — buy, renew or upgrade

**Studio home → SUBSCRIBE** shows a short overview:

- **Your package** and **valid until**: a date, **LIFETIME**, **INCLUDED WITH INFINITY**, or for FREE *7 days every month from deploy*
- **Bots used / limit**
- One line per package (price, bots, brokers)

Tapping a package opens its **details**: ✅ **WHAT YOU GET** and 🔒 **NOT INCLUDED**, point by point for every feature group, plus a **MONTHLY / YEARLY** switch and the **BUY · price** button.

| Button | What it does |
|---|---|
| **LITE** · **PRO** · **ELITE** | Opens that package. Your current package is shown in green |
| **Back** | Studio home |

**Step 1 — Billing period.** Tapping a package opens the period picker:

| Button | What it does |
|---|---|
| **MONTHLY** | 30 days at the monthly price |
| **YEARLY** | 365 days at the yearly price. You save 2 months: LITE saves $60, PRO $110, ELITE $160 |
| **Back** | Package list |

**Step 2 — Payment.** The order card shows the package, period, price, bots, features (x / 23), brokers, strategy and validity.

| Button | What it does |
|---|---|
| **BINANCE PAY** | Pay with Binance Pay |
| **USDT — TRC20** | Pay USDT on Tron |
| **USDT — BEP20** | Pay USDT on BNB Smart Chain |
| **Back** | Period picker |

A payment order stays valid for **1 hour**. The package **activates automatically** as soon as the payment is verified, and you can create your bot right away.

| Situation | What happens |
|---|---|
| New package | Starts today |
| **Renew** the same package | The new days are **added to your current expiry** |
| Switch to another package | A new period starts today |
| Tap the package you already own | A **PACKAGE ALREADY ACTIVE** card with your validity, bots, features, brokers and strategy, plus **RENEW** if the package has an expiry |

---

## 13.5 Before you start: get a bot token

1. Open **@BotFather** in Telegram and send **`/newbot`**.
2. Choose a display name and a username that ends in **`bot`** (for example `MySignalsBot`).
3. BotFather sends a **token** that looks like `1234567890:AAEabc...xyz`. Copy all of it.

⚠️ Your token is the key to your bot. **Never share it with anyone else.**

---

## 13.6 CREATE — the 9 steps

```
CREATE
 └─ 1 BOT TOKEN ─▶ 2 BRAND NAME ─▶ 3 SUPPORT ─▶ 4 TIMEZONE ─▶ 5 WELCOME
     ─▶ 6 ABOUT ─▶ 7 HELP ─▶ 8 FEATURES ─▶ 9 FORCE JOIN ─▶ REVIEW ─▶ DEPLOY 🚀
```

Every step has a **Back** button that returns to the previous step without losing what you entered.

### Step 1 / 9 — BOT TOKEN

This step explains how to get a token from @BotFather and what the token looks like. **Paste the full token** as a message.

- You see a short **🔍 CHECKING BOT TOKEN… ▰▰▰** animation. Your message with the token is **deleted** for safety.
- ❌ **INVALID BOT TOKEN**: the format is wrong or Telegram rejected it. Send it again.
- ⚠️ **This bot is already registered by another user**: revoke the token in BotFather (`/revoke`), create a new one and try again.

| Button | What it does |
|---|---|
| **Back** | Studio home |

### Step 2 / 9 — BOT VERIFIED + BRAND NAME

This step shows your bot's **name**, **@username** and **bot ID**. Then **send your brand name** (max **32 characters**).

The brand name appears in **menus, signals, results, charts, watermarks and partial reports**. It replaces "QUANTEX" and keeps the same font. To keep your bot's current name, send that name.

| Button | What it does |
|---|---|
| **Back** | Step 1 (token) |

### Step 3 / 9 — SUPPORT ACCOUNT

This is the Telegram account your users contact. It is used on every **Support / Contact** button and in help texts.

| Button / input | What it does |
|---|---|
| *(send `@username`)* | Sets that account (5+ characters: letters, numbers, underscore) |
| **USE MY PROFILE USERNAME** | Uses your own Telegram username |
| **SKIP** | Uses your own account |
| **Back** | Step 2 |

### Step 4 / 9 — TIMEZONE

Your bot runs on this timezone. Live Signal, Live Session, Checkers, Future Signals and charts all use it. Examples on screen: Bangladesh +06, India +05:30, Pakistan +05, Nigeria +01, Brazil −03.

| Button | What it does |
|---|---|
| **UTC offset buttons** (21 per page) | Pick your timezone. The active one is green ✅ |
| **PREV** / **NEXT** | More offsets |
| **Back** | Step 3 |

### Step 5 / 9 — WELCOME MESSAGE

This is the message users see on `/start`. Choose from **5 premium templates**:

| Template | Style |
|---|---|
| **TEMPLATE 01** | Clean & Professional |
| **TEMPLATE 02** | Modern & Premium |
| **TEMPLATE 03** | AI & Futuristic |
| **TEMPLATE 04** | Luxury & Elite |
| **TEMPLATE 05** | Bold & Powerful |

Tap a template to see a **preview with your brand name**, then:

| Button | What it does |
|---|---|
| **CONFIRM** | Applies it and goes to Step 6 |
| **BACK** | Back to the template list |
| **Back** *(on the list)* | Step 4 |

> Welcome, About and Help use **templates only** (no free text), so every bot looks clean and professional.

### Step 6 / 9 — ABOUT MESSAGE

Shown when users open **ABOUT**. There are 5 templates: **① PROFESSIONAL** (clean), **② AI STYLE** (modern & tech), **③ PREMIUM** (luxury & elegant), **④ SMART** (short & powerful) and **⑤ ELITE** (bold & advanced).
Preview → **CONFIRM** / **BACK**. **Back** on the list returns to Step 5.

### Step 7 / 9 — HELP MESSAGE

Shown on the **HELP** button. **TEMPLATE 01 – 05**, preview → **CONFIRM** / **BACK**. **Back** returns to Step 6.

### Step 8 / 9 — SELECT FEATURES

Every feature you select becomes **a button in your bot's main menu**. Unselected features stay hidden. A progress bar shows `selected / total`.

| Button | What it does |
|---|---|
| **CORE n/2** · **CHECKERS n/4** · **FUTURE SIGNALS n/6** · **SIGNALS n/3** · **TOOLS n/4** · **USER n/5** | Opens that group |
| **SELECTALL** / **CLEARALL** | Selects every feature your package allows / clears all |
| **NEXT** | Step 9 |
| **Back** | Step 7 |

Inside a group, tap a feature to tick ✅ or untick it, or use **SELECT GROUP**, **CLEAR GROUP** and **DONE**.
A feature your package does not include shows **🔒 — PRO** (or the package it needs). Tapping it explains how to unlock it.

| Group | Features |
|---|---|
| **CORE** | START LIVE SESSION · SCHEDULE SESSION |
| **CHECKERS** | LIVE CHECKER · OTC CHECKER · BLACKOUT CHECKER · WHITEOUT CHECKER |
| **FUTURE SIGNALS** | OTC MARKET FS · LIVE MARKET FS · BLACKOUT FS · WHITEOUT FS · FUTURE LIVE · AXTIRON FS |
| **SIGNALS** | LIVE SIGNAL · LIVE PAYOUTS · NEWS SIGNAL |
| **TOOLS** | FORMATTER · MARKET FILTERS · SWAP C/P · TZ CONVERTER |
| **USER** | MY PROFILE · ABOUT · REVIEWS · HELP · 🔒 REFERRAL *(coming soon)* |

**Which package includes which feature**

| Feature | FREE | INFINITY | LITE | PRO | ELITE |
|---|:-:|:-:|:-:|:-:|:-:|
| START LIVE SESSION | — | ✅ | ✅ | ✅ | ✅ |
| SCHEDULE SESSION | — | — | ✅ | ✅ | ✅ |
| LIVE CHECKER · OTC CHECKER | — | ✅ | ✅ | ✅ | ✅ |
| BLACKOUT CHECKER · WHITEOUT CHECKER | — | — | ✅ | ✅ | ✅ |
| LIVE SIGNAL | ✅ | ✅ | — | ✅ | ✅ |
| OTC MARKET FS | ✅ | ✅ | — | ✅ | ✅ |
| LIVE MARKET FS | — | — | — | ✅ | ✅ |
| LIVE PAYOUTS | — | ✅ | — | ✅ | ✅ |
| NEWS SIGNAL | — | — | — | ✅ | ✅ |
| AXTIRON FS | — | — | — | ✅ | ✅ |
| BLACKOUT FS · WHITEOUT FS · FUTURE LIVE | — | — | — | — | ✅ |
| FORMATTER · MARKET FILTERS · SWAP C/P · TZ CONVERTER | — | — | ✅ | ✅ | ✅ |
| MY PROFILE · ABOUT · HELP | — | ✅ | ✅ | ✅ | ✅ |
| REVIEWS | — | — | ✅ | ✅ | ✅ |
| **Total** | **2** | **9** | **14** | **20** | **23** |

### Step 9 / 9 — CHANNEL MEMBERSHIP (Force Join)

Should users have to join your channel before they can use the bot?

| Button | What it does |
|---|---|
| **ENABLE** | Set up your channel (below) |
| **SKIP** | No force join (you can turn it on later in Customize) |
| **Back** | Step 8 |

To **ENABLE**: ① add your bot to the channel as an **admin**, then ② send `@yourchannel`, a `https://t.me/yourchannel` link, or **forward any post** from the channel (for private channels). The bot checks the channel with a short animation. If it can't find the channel or isn't an admin there, it tells you what to fix.

With Force Join **ON**, non-members see a **JOIN** card instead of the menu, and users who leave are asked to join again.

> FREE bots cannot use Force Join.

---

## 13.7 REVIEW & DEPLOY

The review card shows the bot name, @username, brand, support, timezone, brokers, number of features (the first six are listed), welcome template and force-join status.

| Button | What it does |
|---|---|
| **DEPLOY** | Builds and starts your bot |
| **Back** | Step 9 |
| **CANCEL** | Discards the draft and returns to Studio home |

**DEPLOY animation (about 4 seconds).** A progress bar runs from 0 % to 100 % (▰▰▰▱▱▱) while the stages tick off:

1. ✅ Connected to Telegram
2. ✅ Bot token verified
3. ✅ Brand & messages applied
4. ✅ Features loaded
5. ✅ Brokers & timezone set
6. ✅ Signal engine running

A second tap during the animation is ignored ("Deploying… please wait"). Then **✅ YOUR BOT IS LIVE** appears with your bot's link. Open it and send `/start` to see your custom menu.

> 🆓 If you have no package, deploying your **first** bot starts your **FREE** bot (see [13.13](#1313-run-time-rules-free-infinity-reminders)).

---

## 13.8 MY BOTS — manage a bot

**Studio home → MYBOTS** lists your bots (🟢 running / 🔴 stopped) and a **CREATE** button. Tap a bot to open its detail screen: status, title, number of features, users (total / active today), deploy date and the last error, if any.

| Button | What it does |
|---|---|
| **START BOT** / **STOP BOT** | Turns the bot on or off |
| **CUSTOMIZE** | Every customisation option ([13.9](#139-customize--every-option)) |
| **CHANGE TOKEN** | Send a new BotFather token (for example after `/revoke`). Settings, users and data stay |
| **ANALYTICS** | Users total / today, actions today / total, signals today / total |
| **DELETE BOT** | Asks you to **CONFIRM**, then stops the bot and erases its features, branding, texts and analytics. The Telegram bot itself stays in your BotFather account. **This cannot be undone** |
| **Back** | My Bots |

---

## 13.9 CUSTOMIZE — every option

**MYBOTS → (your bot) → CUSTOMIZE.** The screen summarises the brand, support, welcome template, signal / result / future templates, chart template, brokers, timezone and force join. **Every change applies from the very next message**, so you never need to restart.

| Button | What you can change |
|---|---|
| **WELCOME** | Pick another of the 5 Welcome templates (preview → **CONFIRM**) |
| **ABOUT** | Pick one of the 5 About templates (preview → **CONFIRM**) |
| **HELP** | Pick one of the 5 Help templates (preview → **CONFIRM**) |
| **SUPPORT** | Send a new support `@username` |
| **BRAND** | Send a new brand title (max 32). It replaces QUANTEX everywhere you haven't customised yourself and keeps each section's font |
| **BUTTONS** | **CHANGE BUTTON COLOUR** (Blue / Green / Red) · **CHANGE BUTTON NAME** (text only, max 30) · **CHANGE FONT STYLE** (**BOLD** or **MONOSPACE** for all buttons) · **CHANGE BUTTON EMOJI** (send a premium emoji to use as the button icon) · **RESET ALL BUTTONS**. Each button keeps its job, and the editor shows every button exactly as it looks now |
| **FEATURES** | Tick / untick features by group and **SAVE**. Users see the change at once |
| **BROKERS** | Turn brokers on or off for your users (PRO: any 2, ELITE: all 3; at least one stays on). LITE / FREE / INFINITY run on QUOTEX and show **UPGRADE** |
| **FORCEJOIN** | **SETUP** / **CHANGE** the channel and **Turn ON / Turn OFF** |
| **SET TIMEZONE** | Change the bot's timezone (same picker as Step 4) |
| **CHART TEMPLATE** | **TEMPLATE 01 — CLASSIC QUANTUM** (the original neon design), **TEMPLATE 02 — AI TERMINAL** (graphite terminal with quality rings) or **TEMPLATE 03 — PULSE PRO** (navy panel with performance bars). Each shows a live preview chart. **CHANGE WATERMARK** sets the text for **LIVE SESSION**, **LIVE SIGNAL** or **SET BOTH AT ONCE**, or **RESET TO BRAND** |
| **LIVE SIGNAL TEMPLATE** | **01 CLASSIC** (original format) · **02 BOX FRAME** (framed card with arrow rows) · **03 PREMIUM STAR** (trend, strength and owner line). Preview → apply. One choice is used for both **Live Signal** and **Live Session** |
| **LIVE RESULT TEMPLATE** | **01 CLASSIC** · **02 CROWN SURESHOT** (crown header, big result banner) · **03 PREMIUM STAR** (short asset / signal / result card). Preview with a WIN or LOSS sample → apply. Used for both Live Signal and Live Session |
| **FUTURE SIGNAL TEMPLATE** | How OTC / LIVE future-signal lists look (**TEMPLATE 01 — CLASSIC**; more coming) |
| **AXTIRON FS TEMPLATE** | How AXTIRON future signals look (**TEMPLATE 01**; more coming) |
| **NEWS SIGNAL TEMPLATE** | How news signals look (**TEMPLATE 01**; more coming) |
| **STUDIO CONTROL** | Opens the web app ([13.10](#1310-studio-control--the-web-app)) |
| **Back** | Bot detail |

**Template rule.** FREE, INFINITY and LITE bots stay on **TEMPLATE 01** for Welcome, About, Help, Live Signal, Live Result and Chart. They can **preview** every template, but applying one shows a short "available on PRO / ELITE" message. Future, AXTIRON and News templates are open to every package.

**FREE bots** also have **BUTTONS**, **CHART watermark**, **FORCEJOIN** and **SUPPORT** locked (shown with 🔒).

---

## 13.10 STUDIO CONTROL — the web app

**CUSTOMIZE → STUDIO CONTROL** opens a full control panel inside Telegram. Every change is saved to your bot at once and the panel refreshes instantly.

| Tab | What you can do |
|---|---|
| **Overview** | Bot name, @username, running state, users and package at a glance |
| **Brand** | Your brand identity (brand name) |
| **Features** | Turn features on or off by group (package limits shown) |
| **Strategy** | Choose what your bot trades with ([13.11](#1311-strategies-for-your-bot)) |
| **Texts** | Welcome / About / Help presets and **every template section** (Live Signal, Live Result, Chart, Future, AXTIRON, News) with **Preview** and **Confirm** |
| **Buttons** | **Drag-and-drop button layout**: a 3D preview of your bot's home menu. Drag buttons to new rows and positions, then **Save**, or **Reset** to the default. You can also rename and recolour any button |

---

## 13.11 Strategies for your bot

**STUDIO CONTROL → Strategy.** The strategy you pick is used **only by this bot**. It never changes the main bot or your other bots, and a bot with its own strategy also keeps its own market cooldowns.

| Source | What it is | Package |
|---|---|---|
| **MAIN BOT** | Offer the main bot's analyzers as buttons in your bot: **QUANTUM SCAN** (dynamic MTF + structure), **SMART FOCUS** (best-quality markets), **HYBRID ENGINE** (MTF + structure + trap), **Hybrid Engine V2 Astra** (RSI level flow, AUTO) and **QUANTEX TURBO** (MACD cross + EMA 50 trend) | All. FREE / INFINITY pick **1**, LITE **2**, PRO **3**, ELITE **all 5** |
| **PRE-MADE (10)** | RSI REVERSAL · EMA CROSS · BOLLINGER BOUNCE · MACD CROSS · STOCHASTIC CROSS · RSI + EMA · RSI + BOLLINGER · EMA + BOLLINGER · MACD + EMA · RSI + EMA + BOLLINGER | LITE, PRO, ELITE |
| **STYLES (7)** | REVERSAL · TREND FOLLOWING · PULLBACK · SUPPLY / DEMAND REJECTION · BREAKOUT · MOMENTUM · RANGE BOUNCE | PRO, ELITE |
| **CUSTOM (5 indicators)** | Tick RSI, EMA 9/21, Bollinger Bands, MACD and/or Stochastic. A signal needs **all ticked indicators to agree** | PRO, ELITE |
| **BUILDER (20 indicators)** | Build your own engine from RSI, EMA cross, SMA cross, Bollinger, MACD, Stochastic, CCI, Williams %R, ADX/DMI, Parabolic SAR, Keltner, Donchian, Momentum, ROC, Supertrend, Ichimoku, Awesome Oscillator, TRIX, Aroon and Price Action. **Every value is editable** (periods, levels, multipliers…), and you set the rule **"at least N must agree"** (or ALL AGREE) | ELITE |
| **STRATEGY 1 / STRATEGY 2** | Run **two strategies at once** as two buttons in your bot, each with **its own name and short description** | ELITE |

Each strategy has its own emoji and a one-line description, so your users understand what they are choosing.

---

## 13.12 Your bot's ADMIN PANEL

Inside **your own bot**, you (the owner) are the admin. Send **`/admin`** there.

**🛠 ADMIN PANEL** shows users (total / today), licensed users, banned users, actions today and the access mode.

| Button | What it does |
|---|---|
| **USERS** | Everyone who used your bot (**PREV / NEXT**). Tap a user for the actions below |
| **LICENSES** | Licensed users with tier and days left, plus **GIVE LICENSE** |
| **BROADCAST** | Message all non-banned users. You get a sent / failed report |
| **BANNED** | Banned users |
| **STATS** | Users, active today, actions and signals (**REFRESH**) |
| **LOGS** | The latest events of your bot (**REFRESH**) |
| **ACCESS ➜ OPEN / LICENSED** | **OPEN** = anyone may use the bot. **LICENSED** = only users you licensed. Tap to switch |
| **ADMIN WEB** | The full web admin |
| **GUIDE** | Admin commands |

**User actions** (tap a user): **7 DAYS** · **30 DAYS** · **PERMANENT LICENSE** · **REMOVE LICENSE** · **BAN USER / UNBAN USER** · **RESET USAGE**.

### Admin commands (inside your bot)

| Command | What it does |
|---|---|
| `/admin` | Open the panel |
| `/stats` | Users, activity, licences |
| `/users` | Everyone who used your bot |
| `/broadcast` | Message everyone (or reply to a message with it) |
| `/ban <id>` · `/unban <id>` · `/banlist` | Ban management |
| `/addlicense <id> <days> [tier]` · `/addlicense <id> permanent` | Give a licence (tiers: `free · starter · plus · infinity`) |
| `/removelicense <id>` · `/checklicense <id>` · `/licensedusers` | Licence management |
| `/access open` · `/access licensed` | Who may use the bot |

### ADMIN WEB

| Tab | What you can do |
|---|---|
| **Overview** | Total users, licensed, banned, today |
| **Users** | Search, **Grant License** (days + plan), **Remove License**, **Ban / Unban** |
| **Limits** | Daily **Live** and **Future** limits per tier of your bot (`-1` = unlimited), **Reset All User Limits** |
| **Logs** | Live log viewer |
| **Bot Control** | Status, **Start / Stop**, **Access Mode**, **Send Announcement** |

> 🆓 **FREE bot admin panel:** users, stats and logs work, but **licences, broadcast, bans, usage reset and access changes are locked**. Access is always OPEN, and you and all your users share **30 signals per day**.

---

## 13.13 Run-time rules: FREE, INFINITY, reminders

### 🆓 FREE bot
- Every user gets **one** FREE bot. It is created when you deploy your first bot without a package.
- It runs **7 days in every 30-day cycle**, counted from the first deploy. You get a notice **one day before** it turns on again.
- During those 7 days it runs **4 hours, then rests 2 hours** (about **16 hours a day**).
- Features: **LIVE SIGNAL** + **OTC MARKET FS**. Your own brand name is allowed. Buttons, watermark, force join, support and the admin tools above are locked, and templates stay on 01.

### 👑 INFINITY bot
- Included with the **main-bot INFINITY plan**: 1 bot with 9 features, main-bot strategies (1 analyzer), QUOTEX and templates on 01.
- Runs **6 hours, then rests 2 hours** (about **18 hours a day**), counted from your first bot.

### Rest notices
At each break your bot stops and you get a **BREAK** message with **RENEW STUDIO** (INFINITY) or **UPGRADE** (FREE), which opens the Studio packages. When the break ends, the bot starts again by itself and you get a **BACK ONLINE** notice.

### Expiry reminders (paid packages)
- **3 days before** your package ends you get **one** evening reminder (Bangladesh time) with a **RENEW** button that opens the MONTHLY / YEARLY picker.
- When a package ends, its bots are paused and you get a notice with **RENEW**. After you renew, they start again automatically.
- If you move to a package with fewer bots, the extra bots are paused until you upgrade or delete a bot.

---

## 13.14 Privacy & isolation

- Each bot's **users, licences, bans, limits, usage, texts, strategy and logs belong to that bot only**. Nothing is shared with the main bot or your other bots.
- A user's main-bot plan (for example INFINITY) **does not** carry over into your bot. In your bot, only the licences **you** give count.
- Platform-only parts (main-bot payments, the upgrade page, the QUANTEX HUB / Web Control / Live Chart web apps and personal settings) never appear in your bot.
- Your bot token is checked privately, the message containing it is deleted, and tokens are never written to logs.

---

## 13.15 Troubleshooting

| Problem | Fix |
|---|---|
| **INVALID BOT TOKEN** | Copy the whole token from BotFather (it contains a `:`), or get it again with `/token` |
| **Already registered by another user** | `/revoke` in BotFather, then use the new token |
| **Force Join doesn't work** | Make sure the bot is still an **admin** in the channel, then go to CUSTOMIZE → FORCEJOIN → CHANGE |
| **"🔒 — PRO" on a feature or template** | Your package doesn't include it. SUBSCRIBE → PRO or ELITE |
| **My bot stopped by itself** | It is a FREE / INFINITY break (it starts again on its own), or your package ended. Check SUBSCRIBE |
| **Can't create another bot** | Bot limit reached. Upgrade or delete a bot |
| **Changed the token in BotFather** | MYBOTS → bot → **CHANGE TOKEN** |

[⬅ Free Bots](12-free-bots.md) · [Back to the User Guide](../user-guide.md) · [Studio release notes](../studio.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
