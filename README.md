<div align="center">

<img src="https://img.shields.io/badge/QUANTEX--BOT-ULTRA%20v5.0-00ff88?style=for-the-badge&labelColor=0a0a0a&logo=telegram" alt="QUANTEX-BOT" />

# 🔮 QUANTEX-BOT — Binary Trading Signal System

**The Most Advanced Binary Options Signal Bot on Telegram**

[![Telegram Bot](https://img.shields.io/badge/Telegram-QuantexBinaryTools__bot-2CA5E0?style=flat-square&logo=telegram&logoColor=white)](https://t.me/QuantexBinaryTools_bot)
[![Main Channel](https://img.shields.io/badge/Main%20Channel-bdtraderpro-ff4757?style=flat-square&logo=telegram&logoColor=white)](https://t.me/bdtraderpro)
[![Channel](https://img.shields.io/badge/Channel-Quantexbot1-2CA5E0?style=flat-square&logo=telegram&logoColor=white)](https://t.me/Quantexbot1)
[![Owner](https://img.shields.io/badge/Owner-X__Akash__Owner-blueviolet?style=flat-square&logo=telegram)](https://t.me/X_Akash_Owner)
[![Version](https://img.shields.io/badge/Version-5.0.0-00ff88?style=flat-square)](https://t.me/QuantexBinaryTools_bot)
[![Brokers](https://img.shields.io/badge/Brokers-QUOTEX%20%7C%20TRADOWIX%20%7C%20BINOLLA-ffb400?style=flat-square)](SUPPORTED_MARKETS.md)
[![License](https://img.shields.io/badge/License-Commercial-ff4757?style=flat-square)](https://t.me/X_Akash_Owner)
[![Status](https://img.shields.io/badge/Status-Active%2024%2F7-00ff88?style=flat-square)](https://t.me/QuantexBinaryTools_bot)
[![Database](https://img.shields.io/badge/Database-PostgreSQL-336791?style=flat-square&logo=postgresql)](https://t.me/QuantexBinaryTools_bot)

[![Website](https://img.shields.io/badge/🌐%20Website-quantexbot.pro-2f6bff?style=for-the-badge)](https://quantexbot.pro)
[![Developer API](https://img.shields.io/badge/🔌%20Developer%20API-api.quantexbot.pro-8b5cf6?style=for-the-badge)](https://quantexbot.pro/docs/api)
[![Status](https://img.shields.io/badge/🟢%20System-Status-00b894?style=for-the-badge)](https://quantexbot.pro/status)

---

> **QUANTEX-BOT** is a professional binary options signal system that runs entirely inside Telegram. It supports **three brokers — QUOTEX, TRADOWIX and BINOLLA — with 300+ markets**. Signals come from two engines, **Strategy Mode** and **Scanning Mode**, and a **Strategy Intelligence** layer learns from every real result. Around the signals you get a complete checker suite, Future Signal generators, the **Q-BOT STUDIO** no-code bot builder, the **QUANTEX HUB** community, a **Live Chart**, a Web Control dashboard and instant Auto Payment.

> 🌐 **Website:** [quantexbot.pro](https://quantexbot.pro) — documentation, accounts, the **Developer API**, payments and live system status. · 🔌 **Developer API:** [`https://api.quantexbot.pro/v1`](https://quantexbot.pro/docs/api) — brokers, pairs, payouts, candles, historical candles and live ticks for your own apps and bots.

---

</div>

## 📌 Table of Contents

- [🤖 New: Auto Trading](#-new-auto-trading)
- [🌐 New: Website & Developer API](#-new-website--developer-api)
- [What's New in v5.0](#-whats-new-in-v50)
- [What is QUANTEX-BOT?](#-what-is-quantex-bot)
- [Supported Brokers & Markets](#-supported-brokers--markets)
- [Key Features](#-key-features)
- [How It Works](#-how-it-works)
- [Pricing Plans](#-pricing-plans)
- [Getting Started](#-getting-started)
- [📘 User Guide (step by step)](USER_GUIDE.md)
- [🤖 Q-BOT STUDIO (released 18 Oct 2026)](STUDIO.md)
- [Documentation](#-documentation)
- [Contact & Support](#-contact--support)

---

## 🤖 New: Auto Trading

**QUANTEX is now an auto trading bot** *(released 22 Oct 2026)*. Tap **AUTO TRADING** in the bot, sign in to your own broker account, and every signal you choose is traded for you at the exact entry time.

| | |
|---|---|
| 🔐 **Secure broker connection** | QUOTEX, TRADOWIX and BINOLLA. Your password is never stored — only an encrypted session; reconnects by itself |
| 💰 **Money management** | Fixed stake or % of balance, martingale (steps × multiplier) or the **QUANTEX Recovery** plan |
| 🛑 **Stop loss & take profit** | Reached → auto trading stops by itself and tells you |
| 🎯 **Precision** | Orders reach the broker as the candle opens; safety margin, payout filter, max trades at once, daily limit |
| 📡 **Signal sources** | Live Signal, Live Session and your own future signal lists (OTC, Live, Blackout, Whiteout) |
| 📊 **Dashboard, Log & History** | Live result, terminal log, every trade with amount, payout and result |

**Why auto trading?** No emotions: no chasing losses, no doubling out of fear, no stopping too late. Choose good signals, set your limits, and just watch. → **[Auto Trading guide](guide/14-auto-trading.md)** · available for **PLUS** and **INFINITY**.

> Trading involves risk. Auto Trading follows your settings; it does not guarantee profit. Start on a demo account.

---

## 🌐 New: Website & Developer API

QUANTEX now has its own website and a public **Developer API** for market data.

| | Link | What it is |
|---|---|---|
| 🌐 **Website** | [quantexbot.pro](https://quantexbot.pro) · [বাংলা](https://quantexbot.pro/bn) · [Português](https://quantexbot.pro/pt) | Features, documentation, pricing, updates, FAQ, contact; sign up with email or Google |
| 👤 **Dashboard** | [quantexbot.pro/dashboard](https://quantexbot.pro/dashboard) | Profile, two-step security, notifications, API keys, usage, logs, billing |
| 🔌 **Developer API** | [api.quantexbot.pro/v1](https://api.quantexbot.pro/v1/status) | Market data API: brokers, pairs, payouts, **candles M1–H4**, **historical candles** and **live ticks** (REST + stream) |
| 📘 **API documentation** | [quantexbot.pro/docs/api](https://quantexbot.pro/docs/api) · [DEVELOPER_API.md](DEVELOPER_API.md) | Every endpoint, parameter, example and error code |
| 🧾 **OpenAPI** | [api.quantexbot.pro/v1/openapi.json](https://api.quantexbot.pro/v1/openapi.json) · [api/openapi.json](api/openapi.json) | Machine-readable description for code generators, Postman and AI agents |
| 🤖 **For AI assistants** | [quantexbot.pro/llms.txt](https://quantexbot.pro/llms.txt) · [llms.txt](llms.txt) | The whole documentation as plain text, open to everyone |
| 🟢 **System status** | [quantexbot.pro/status](https://quantexbot.pro/status) | Website, API, data engine, Telegram bot and payments, checked every minute |
| 💳 **API plans** | [quantexbot.pro/pricing](https://quantexbot.pro/pricing) | Developer (free), Candle Basic $15, Candle Data API $30, Full Market Data API $50 — paid with Binance Pay or USDT, verified automatically |
| 🤖 **QUANTEX AI** | on every page | 24/7 support assistant in English, বাংলা and Português |

**Developer API in one minute**

```bash
# 1. Create a free account at https://quantexbot.pro/register and an API key in Dashboard → API keys
# 2. Ask for the open OTC pairs of QUOTEX:
curl "https://api.quantexbot.pro/v1/pairs?broker=quotex&market=otc&open=true" \
  -H "Authorization: Bearer qx_live_YOUR_KEY"
# 3. Get the latest M1 candles of a pair:
curl "https://api.quantexbot.pro/v1/candles?broker=quotex&pair=EURUSD_otc&tf=M1&limit=100" -H "Authorization: Bearer qx_live_YOUR_KEY"
```

| Read more | |
|---|---|
| [WEBSITE.md](WEBSITE.md) | Everything on the website, page by page |
| [DEVELOPER_API.md](DEVELOPER_API.md) | Complete Developer API documentation (all endpoints) |
| [ARCHITECTURE.md](ARCHITECTURE.md) | How the bot, website and API work together |
| [examples/](examples/) | Ready-to-run code: Python, Node.js, PHP, cURL |

---

## 🆕 What's New in v5.0

| Update | What it means for you |
|---|---|
| 🏦 **3 brokers, fully supported** | **QUOTEX, TRADOWIX and BINOLLA** each have their own live feed, payouts and result checking. Set a **Primary Broker** once and every feature uses it automatically. → [Full market list](SUPPORTED_MARKETS.md) |
| ⚡ **Super-fast performance** | The analysis engine was rebuilt and runs about **14× faster**. Taps on menu buttons get an instant response, screens open without waiting, and heavy work no longer slows anyone else down. |
| 🛡 **24/7 stability** | Built to run non-stop for weeks. It recovers on its own if anything stalls, monitors itself and restarts automatically if the process ever stops. |
| 🤖 **Q-BOT STUDIO** 🟢 *released 18 Oct 2026* | Build your **own branded Telegram signal bot** in 9 guided steps and deploy it in seconds: templates, features, your own strategy, drag-and-drop buttons and your own admin panel. Packages: **FREE**, **LITE $30**, **PRO $55**, **ELITE $80**. → [STUDIO.md](STUDIO.md) |
| 🧠 **Strategy Intelligence** | Learns from every settled result per market, timeframe and hour. It favours the setups and analyzers that actually win on each market and avoids weak ones, so accuracy keeps improving over time. |
| 📡 **Scanning Mode** | A second signal engine next to Strategy Mode. It tracks supply/demand zones and trendlines on every market at once and shares signals instantly. |
| 🌐 **QUANTEX HUB** | A built-in trading community: posts, comments, likes, direct messages, leaderboards, profiles and market news. |
| 📈 **Live Chart** | A professional candlestick chart for every market of every broker, from M1 up to D1 with 30 days of history, live inside Telegram. |
| 🔮 **AXTIRON FS & AI FILTER** | A new advanced Future Signal generator (M1–M15, 1–5 hours), and an AI Filter that checks any future-signal list against 1–30 days of market history. |
| 👥 **Group Live Signal** | Bot owners (for example with a Q-BOT STUDIO bot) can run Live Signal directly inside a Telegram group with `/start_live_signal`. |

---

## 🔮 What is QUANTEX-BOT?

**QUANTEX-BOT** is a fully automated binary options signal system delivered through Telegram. It watches the markets of your broker, runs its analysis engines and sends clear **BUY (CALL)** or **SELL (PUT)** signals. Each signal comes with an entry time, a chart, payout and support/resistance levels, and the WIN / LOSS result is checked automatically after the candle closes.

Highlights:

- ✅ **Three brokers**: QUOTEX, TRADOWIX and BINOLLA, with OTC and Live markets
- ✅ **Two signal engines**: **Strategy Mode** (QUANTUM SCAN · SMART FOCUS · HYBRID ENGINE) and **Scanning Mode** (zones and trendlines)
- ✅ **Strategy Intelligence**: self-improving, data-driven strategy selection
- ✅ **AI confirmation**: Live Signals are checked by AI with payout, S/R levels and a written reason
- ✅ **Live Signal**: manual and auto signals in your DM, plus Group Live Signal for bot owners
- ✅ **Live Session** *(paid plans)*: continuous signals to your channel on M1, M2, M3, M5, M10 or M15, plus **Schedule Session**
- ✅ **Signal Checker suite**: Live, OTC, Blackout, Whiteout and any custom date
- ✅ **Future Signals**: OTC FS, Live FS, Blackout FS, Whiteout FS, Future Live and **AXTIRON FS**
- ✅ **AI Filter**: filter any future-signal list with AI
- ✅ **News Signal**: signals from the economic calendar, with AI direction analysis
- ✅ **Signal Tools**: Formatter, TZ Converter, Market Filters, Live Payouts (Swap C/P coming soon)
- ✅ **Auto Trading** *(released 22 Oct 2026)*: the bot trades the signals on your own QUOTEX, TRADOWIX or BINOLLA account — stop loss / take profit auto stop, martingale or QUANTEX Recovery, safety margin, payout filter → [guide](guide/14-auto-trading.md)
- ✅ **Q-BOT STUDIO** *(released 18 Oct 2026)*: build your own branded bot in 9 steps, no coding. FREE / LITE / PRO / ELITE packages → [STUDIO.md](STUDIO.md)
- ✅ **QUANTEX HUB**: community, messaging and news
- ✅ **Live Chart** and **Web Control** dashboards inside Telegram
- ✅ **Auto Payment**: Binance Pay, TRC20 and BEP20 USDT with instant activation
- ✅ **Free Bots Mission**: 5 free premium tools already released
- ✅ **Telegram Premium emoji** support
- ✅ **PostgreSQL** backend and 24/7 self-healing runtime

> 🤖 **Telegram Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)

---

## 🏦 Supported Brokers & Markets

| Broker | OTC Markets | Live Markets | Total |
|---|---|---|---|
| 🟦 **QUOTEX** | **62** | **28** | **90** |
| 🟧 **TRADOWIX** | **101** | **15** | **116** |
| 🟪 **BINOLLA** | **104** | **17** | **121** |

**All three brokers are fully supported** across every feature: Live Session, Live Signal (Strategy and Scanning Mode), all Checkers, all Future Signal modes, AXTIRON FS, AI Filter, Live Payouts, Market Filters and the Live Chart.

- **QUOTEX**: Forex, Crypto and Commodities in OTC, plus Live Forex, Gold and world indices (France 40, UK 100, Hong Kong 50, Japan 225, Euro Stoxx 50 and more)
- **TRADOWIX**: Forex, Crypto, Commodities and **25 US/global stocks** (Apple, Tesla, NVIDIA, Microsoft and more) in OTC, plus Live Forex and Crypto
- **BINOLLA**: 27 Forex (incl. exotics like USD/BDT, USD/INR, USD/BRL), 9 Crypto, 7 Commodities, 11 Indices and **50 global stocks** in OTC, plus 17 Live Forex pairs. The list is read live from the BINOLLA feed, so new markets appear automatically

👉 **Every market name, broker by broker, is listed in [SUPPORTED_MARKETS.md](SUPPORTED_MARKETS.md).**

> 💡 **Primary Broker:** go to **Settings → Primary Broker** to choose your broker once. Turn on *"Use this broker in all features"* and the bot stops asking.

---

## ✨ Key Features

### 📡 Signal Engines
| Feature | Description |
|---|---|
| **Strategy Mode** | Three analyzers: **QUANTUM SCAN** (dynamic MTF + structure, trend continuation), **SMART FOCUS** (focuses on the best-quality markets) and **HYBRID ENGINE** (MTF + structure + trap detection, continuation and confirmed reversals) |
| **Scanning Mode** | One shared market scanner tracks every open market at once and trades confirmed **supply/demand zone** rejections, **trendline** rejections and **break-and-retest** setups. Optional multi-timeframe confirmation is available. |
| **Accurate levels** | Zones that price has already broken are discarded, and trendlines must be clean, with no candle closing through them. Signal charts show the exact zone or trendline the signal came from. |
| **Multi-timeframe** | Live Session: M1, M2, M3, M5, M10, M15. Scanning Mode: M1, M2, M3, M5. All higher timeframes are built on real clock boundaries. |
| **20+ analysis modules** | Trend Continuation, Break of Structure, Change of Character, Engulfing, MACD, RSI Divergence, Bollinger, Pin Bar, MTF Confluence, VWAP, Ichimoku, Fibonacci, Supertrend + PSAR, CCI, Tweezer, Three Black Crows and more |
| **Final candle filter** | Every strategy signal must pass a closed-candle quality gate before it is sent |
| **MTG system** | Automatic MTG recovery step on a loss, with results shown as WIN, MTG WIN or LOSS |

### 🧠 Strategy Intelligence *(rebuilt in v5.0)*
| Feature | Description |
|---|---|
| **Learns from real results** | Every settled signal is stored with its analyzer, market, timeframe, hour and setup type |
| **Per-analyzer judgement** | Each analyzer is judged on its **own** record on each market |
| **Setup preference** | If continuation clearly beats reversal on a market (or the other way round), the weaker setup is filtered out there |
| **Smart routing** | When another analyzer has proven clearly better on a market (enough data, a large edge), that market is analysed by the better one. Admins can switch this on or off. |
| **Safe auto-tuning** | Markets that keep under-performing get stricter filters, step by step and within safe limits |
| **Recommended analyzer** | Strategy Mode highlights the analyzer with the strongest proven record |
| **Scanning statistics** | Scanning Mode records every signal so its win rate can be reviewed by setup, score, pair and hour |

### 🤖 AI-Assisted Live Signal
| Feature | Description |
|---|---|
| **Manual Signal** | Get one AI-confirmed signal on demand for the pair and timeframe you choose |
| **Auto Signal** | The bot scans all markets and sends the strongest setups automatically, in Strategy Mode or Scanning Mode |
| **AI confirmation** | AI reviews the setup and adds a confidence level and a written reason |
| **S/R and payout** | Every signal shows support, resistance and the live broker payout |
| **Charts** | A professional signal chart, plus a result chart after the candle closes |
| **Channels and groups** | Live Signal in your DM, Live Session in your channel (paid plans), and **Group Live Signal** for bot owners |

### 🔍 Signal Checker Suite
| Mode | Description |
|---|---|
| **Live Checker** | WIN/LOSS for live-market signals |
| **OTC Checker** | WIN/LOSS for OTC signals |
| **Blackout Checker** | For direction-free signals: reverse of the previous candle colour |
| **Whiteout Checker** | For direction-free signals: follows the previous candle colour |
| **Today / Yesterday / Custom Date** | Check any past date from archived candles |

All checkers are super-fast and exact: a direct candle comparison with a universal signal parser, DOJI detection, MTG levels (WIN¹, WIN²), a payout filter and premium-emoji output.

### 🔮 Future Signals
| Mode | Description |
|---|---|
| **OTC Market FS** | Future signal list for OTC markets |
| **Live Market FS** | Future signal list for live markets |
| **Blackout FS / Whiteout FS** | Future lists for blackout- and whiteout-style trading |
| **Future Live** | Paste any signal list: each signal is posted at its exact time and the result is checked automatically |
| **AXTIRON FS** *(new)* | Advanced future signal generator for OTC or Live markets, M1–M15, covering 1 to 5 hours |
| **AI Filter** *(new)* | Upload a future-signal list (OTC, Live, Blackout or Whiteout) and it is scored against 1–7, 7–15 or 15–30 days of history, so only the strongest entries are kept |

### 📰 News Signal
Signals from the economic calendar. AI decides the direction of each event, blends it with technical structure and maps it to CALL/PUT pairs. Covers **29 pairs** (all majors, crosses and XAU/USD) with filters for impact (High / Medium / Low) and range (1–3 days).

### 🛠 Signal Tools
| Tool | Description |
|---|---|
| **Formatter** | Rebuild any signal list into a clean card |
| **Swap C/P** | Flip every CALL ↔ PUT *(coming soon)* |
| **TZ Converter** | Convert signal times between timezones |
| **Market Filters** | Shows which OTC / Live markets are stable right now |
| **Live Payouts** | Live payout % of every market of your broker |

### 🤖 Q-BOT STUDIO: Build Your Own Bot *(no coding · 🟢 released 18 Oct 2026)*

> Build your **own branded signal bot** in 9 guided steps and deploy it in about 4 seconds. Studio has its **own packages**: **FREE** (1 bot for everyone), **LITE $30**, **PRO $55** and **ELITE $80** per month (yearly $300 / $550 / $800). INFINITY Bot Access users also get 1 Studio bot. → [Release notes](STUDIO.md) · [Complete A → Z guide](guide/13-qbot-studio.md)

| Feature | Description |
|---|---|
| **9-step guided wizard** | Bot token → brand name → support → **timezone** → **Welcome** → **About** → **Help** → features → force join → review → **DEPLOY** (animated, ~4 s) |
| **Ready-made templates** | 5 Welcome, 5 About and 5 Help templates; 3 chart templates; 3 Live Signal + 3 Live Result templates; Future / AXTIRON / News template sections |
| **Pick your features** | Up to **22** QUANTEX features (Live Session, Schedule, checkers, future signals, Live Signal, payouts, news, tools…) as menu buttons |
| **Your strategy** | Main-bot analyzers, 10 pre-made strategies, 7 trading styles, a custom indicator mix or a **20-indicator builder with editable values**; ELITE runs 2 named strategies at once |
| **Full customisation** | Brand replaces QUANTEX in the same font; button names, colours, BOLD / MONOSPACE font, premium emoji icons; **drag-and-drop button layout**; chart watermark; brokers; timezone |
| **STUDIO CONTROL web app** | Overview · Brand · Features · Strategy · Texts · Buttons, saved instantly |
| **My Bots** | Start, stop, customise, change the token, view analytics or delete at any time |
| **Your Admin Panel** | `/admin` in your bot + Admin Web: users, licences, bans, broadcasts, limits, logs and stats; **open** or **licensed** access |
| **Isolation** | Each bot's users, licences, data and strategy are fully separate |
| **Packages** | FREE · LITE · PRO · ELITE (+ INFINITY Studio bot) — [see pricing](PRICING.md#-q-bot-studio-packages) |

### 🌐 Web Apps (inside Telegram)
| App | Description |
|---|---|
| **QUANTEX HUB** | Community feed with images and tags, likes, comments, shares, direct messages, leaderboards, profiles with covers, market news and breaking-news alerts |
| **Live Chart** | Candlestick chart for every market of all 3 brokers, M1 → D1, with 30 days of history and live updates |
| **Web Control** | Profile, plan and credits, timezones, templates and referral sharing |
| **Session Log** | Real-time log of every scan, signal and rejection in your live session |

### 💳 Payments & Plans
| Feature | Description |
|---|---|
| **Auto Payment** | Binance Pay, TRC20 USDT or BEP20 USDT, verified automatically with instant activation |
| **Tiered plans** | FREE · STARTER · PLUS · INFINITY |
| **Promo codes & referrals** | Discounts and rewards |

### 🎁 Free Bots Mission
Five free premium tools have been released so far: **HUNTER X QUANTEX**, **DRAGON X QUANTEX**, **BLACKOUT FUTURE AI**, **FUTURE SIGNAL AI** and **QX PERSONAL AI**. Bots #6–10 are coming step by step.

### 💎 More
Telegram Premium emoji (connect your account through a secure login), scheduled sessions, partial reports (every 30 / 60 / 120 min), favourite pairs, history, referral program, reviews and ratings.

---

## 🔧 How It Works

```
User opens the bot
       │
       ▼
Broker: QUOTEX / TRADOWIX / BINOLLA   (or your saved Primary Broker)
       │
       ▼
Choose the engine
  ├─ STRATEGY MODE ─ QUANTUM SCAN / SMART FOCUS / HYBRID ENGINE
  │                   └─ Strategy Intelligence picks the best setup/analyzer per market
  └─ SCANNING MODE ─ shared zone & trendline scanner across every open market
       │
       ▼
Market (OTC / LIVE / All / Avoid <80%)  →  Timeframe (M1 … M15)
       │
       ▼
Signal loop
  ├─ Live candles + live tick from the broker feed
  ├─ Analysis → confidence score → final candle filter
  ├─ (Live Signal) AI confirmation + S/R + payout
  ├─ Signal + chart sent to DM / channel / group
  └─ Candle closes → result checked → WIN / MTG / LOSS → result is learned
```

---

## 💰 Pricing Plans

| Plan | Price | Highlights |
|---|---|---|
| 🆓 **FREE** | $0 | Small daily signal allowance, checkers, tools, free bots |
| 🟢 **STARTER** | **$18/month** | More daily signals, Live Session & Schedule |
| 💎 **PLUS** ⭐ Most Popular | **$32/month** | Much higher limits, full template customisation, Web Control |
| 👑 **INFINITY** | **$49/month** | Unlimited signals, everything in PLUS, + 1 Q-BOT STUDIO bot |

> 🪄 Tap **Upgrade** in the bot for live pricing and subscribe instantly with **Auto Payment**. See [PRICING.md](PRICING.md) for full details.

### 🤖 Q-BOT STUDIO packages *(released 18 Oct 2026)*

| Package | Monthly | Yearly | Bots | Brokers | Features |
|---|---|---|---|---|---|
| 🆓 **FREE** | $0 | — | 1 | QUOTEX | 2 · runs 7 days every 30 days |
| 🟢 **LITE** | **$30** | **$300** | 1 | QUOTEX | 14 |
| 🔵 **PRO** | **$55** | **$550** | 3 | Any 2 | 19 |
| 👑 **ELITE** | **$80** | **$800** | 5 | All 3 | All 22 + 20-indicator builder |

> Buy in **Q-BOT STUDIO → SUBSCRIBE**. Full details: [STUDIO.md](STUDIO.md) · [PRICING.md](PRICING.md#-q-bot-studio-packages)

---

## 🚀 Getting Started

1. Open **[@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)** and send `/start`
2. *(Optional)* **Settings → Primary Broker**: pick QUOTEX, TRADOWIX or BINOLLA
3. Tap **LIVE SIGNAL** or **START LIVE SESSION** and follow the wizard
4. Take each trade at the entry time on your broker
5. Results arrive automatically after each candle closes

Full guide: [GETTING_STARTED.md](GETTING_STARTED.md)

---

## 📚 Documentation

| File | Contents |
|---|---|
| [USER_GUIDE.md](USER_GUIDE.md) | 📘 **Complete step-by-step user manual**: every menu, step and button, with plan availability |
| [STUDIO.md](STUDIO.md) | 🤖 **Q-BOT STUDIO release notes** (18 Oct 2026): all features, packages and pricing |
| [guide/13-qbot-studio.md](guide/13-qbot-studio.md) | 🧙 **Q-BOT STUDIO A → Z guide**: every step, button, panel and package rule |
| [FEATURES.md](FEATURES.md) | Complete feature documentation |
| [SUPPORTED_MARKETS.md](SUPPORTED_MARKETS.md) | Every broker and every market, with counts |
| [GETTING_STARTED.md](GETTING_STARTED.md) | Step-by-step user guide |
| [SIGNAL_GUIDE.md](SIGNAL_GUIDE.md) | How to read and trade a signal |
| [PRICING.md](PRICING.md) | Plans, limits and payment |
| [FAQ.md](FAQ.md) | Frequently asked questions |
| [ROADMAP.md](ROADMAP.md) | Version history and what's next |
| [WEBSITE.md](WEBSITE.md) | 🌐 The website [quantexbot.pro](https://quantexbot.pro): pages, accounts, dashboard, billing, AI support, status |
| [DEVELOPER_API.md](DEVELOPER_API.md) | 🔌 **Developer API**: authentication, keys, limits, every endpoint with examples, tick stream, errors, plans |
| [ARCHITECTURE.md](ARCHITECTURE.md) | 🧩 System architecture: bot, collectors, Engine Bridge, website, API; how a live signal reaches the API |
| [guide/14-auto-trading.md](guide/14-auto-trading.md) | 🤖 **Auto Trading**: connect your broker, settings, money management, stop loss / take profit |
| [examples/](examples/) | 🧪 Code examples (Python, Node.js, PHP, cURL) |
| [api/openapi.json](api/openapi.json) | 🧾 OpenAPI 3.1 file of the API |
| [llms.txt](llms.txt) | 🤖 Index of this documentation for AI assistants |

---

## 📞 Contact & Support

| | Link |
|---|---|
| 🤖 **Telegram Bot** | [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot) |
| 🌐 **Website** | [quantexbot.pro](https://quantexbot.pro) |
| 🔌 **Developer API docs** | [quantexbot.pro/docs/api](https://quantexbot.pro/docs/api) |
| 🟢 **System status** | [quantexbot.pro/status](https://quantexbot.pro/status) |
| ✉️ **Contact form** | [quantexbot.pro/contact](https://quantexbot.pro/contact) |
| 📣 **Main Channel** *(required to use the bot)* | [t.me/bdtraderpro](https://t.me/bdtraderpro) — every update is posted here first |
| 📢 **Official Channel** | [@Quantexbot1](https://t.me/Quantexbot1) |
| 👥 **Community Group** | [t.me/quantexlounge](https://t.me/quantexlounge) |
| 👤 **Owner / Developer** | [@X_Akash_Owner](https://t.me/X_Akash_Owner) |
| 📧 **Support Email** | [quantexbotsupport@gmail.com](mailto:quantexbotsupport@gmail.com) |

---

## ⚠️ Disclaimer

> Binary options trading involves substantial risk of loss, and no signal provider — QUANTEX-BOT included — can guarantee a 100% win rate. Past performance does not guarantee future results. Trade responsibly and only with money you can afford to lose.

**Why traders trust QUANTEX-BOT:**
- 📊 A publicly visible track record and positive community feedback
- 👥 An active **public community group**, [t.me/quantexlounge](https://t.me/quantexlounge), where users openly share results, good and bad
- 🧪 We recommend every new user **test the signals on a demo account** first, so you can verify performance yourself before risking real funds
- 🔒 The Telegram account connection for Premium Mode uses a secure, encrypted login flow, and your credentials are never shared

---

## 👨‍💻 Developer

Built and maintained by **[@X_Akash_Owner](https://t.me/X_Akash_Owner)**.  
All rights reserved. Unauthorized redistribution or resale of subscription access is prohibited.

---

<div align="center">

**⭐ Star this repo and share it with your trading community!**

[![Join Main Channel](https://img.shields.io/badge/Join-Main%20Channel-2CA5E0?style=for-the-badge&logo=telegram)](https://t.me/bdtraderpro)
[![Start Bot](https://img.shields.io/badge/Start-Trading%20Bot-00ff88?style=for-the-badge&logo=telegram)](https://t.me/QuantexBinaryTools_bot)
[![Website](https://img.shields.io/badge/Visit-quantexbot.pro-2f6bff?style=for-the-badge)](https://quantexbot.pro)
[![API](https://img.shields.io/badge/Build%20with-the%20API-8b5cf6?style=for-the-badge)](https://quantexbot.pro/docs/api)

*QUANTEX-BOT — 3 Brokers. 2 Engines. One Intelligent Signal System.*

</div>
