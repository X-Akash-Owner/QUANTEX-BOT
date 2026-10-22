# 🗺️ QUANTEX-BOT — Development Roadmap

> **Official Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)  
> **Developer**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)

---

## ✅ v1.x — Foundation
- [x] Core signal engine
- [x] Basic Telegram bot integration
- [x] OTC pair support

---

## ✅ v2.0 — Full Bot System
- [x] Multi-user Telegram Bot Manager
- [x] Signal Result Auto-Checker
- [x] MTG (Martingale) Recovery System
- [x] Candlestick Chart Generation
- [x] Backtest Statistics
- [x] Session Management
- [x] Scheduled Sessions
- [x] Partial Performance Reports
- [x] License Key System
- [x] Promo Code System
- [x] Admin Control Panel
- [x] Points System
- [x] Signal Checker Engine
- [x] Future Signal Engine
- [x] Quotex OTC + Live support
- [x] Telegram WebApp Login Server

---

## ✅ v3.0 — AI + Live Broadcast + Checker Suite + Free Bots

### 🤖 AI Integration
- [x] AI Signal Confirmation on every Live Signal
- [x] AI Reasoning Output
- [x] Support & Resistance auto-calculation
- [x] Real-Time Payout Display per signal
- [x] AI Confidence Score
- [x] AI Fallback direction when primary analysis fails

### 📡 Live Signal Broadcast
- [x] Channel Broadcasting (Manual & Auto modes)
- [x] Multi-Template Signal Formatting
- [x] Custom Header & Username branding
- [x] MTG in channel broadcast
- [x] Channel permission validation
- [x] Free tier daily signal quota
- [x] Daily quota remaining display
- [x] Live Signal Chart (dedicated)

### ⏱ Future Live Signal System
- [x] Paste any signal list — all formats parsed automatically
- [x] Signals auto-fire at exact scheduled time
- [x] Automatic WIN/LOSS/DOJI result check per signal
- [x] MTG 1 & MTG 2 support in Future Live
- [x] View Signals dashboard (remaining + next signal)
- [x] Session status display with countdown
- [x] Stop session any time
- [x] Full session completion summary
- [x] Free tier: 3 sessions lifetime
- [x] Custom header & username (licensed users)
- [x] Template preview before starting

### 🔍 Signal Checker — 4-Mode Suite
- [x] **OTC Checker** — standard checker rebuilt, super-fast & 100% accurate
- [x] **Blackout Checker** — direction-free signals, reverse previous-candle logic
- [x] **Whiteout Checker** — direction-free signals, follow previous-candle logic
- [x] **Custom Date Checker** — check any specific past date
- [x] O(1) local candle index lookup (pre-built HH:MM map)
- [x] Local candle file cache (near-instant, no API calls needed)
- [x] Archive candle data support (yesterday and custom dates)
- [x] Unicode normalizer (handles bold/italic/fancy Telegram text)
- [x] DOJI detection and separate reporting
- [x] Payout filter per signal (flag low-payout signals)
- [x] MTG breakdown with superscript level
- [x] BD timezone (UTC+6) accurate time matching
- [x] 100+ pair alias normalization
- [x] 60+ OTC + 30+ Live pair support
- [x] Premium emoji formatted output

### 🤖 Free Bots Mission
- [x] Free Bots section added to main menu
- [x] **HUNTER X QUANTEX** — Bot #1 released
- [x] **DRAGON X QUANTEX** — Bot #2 released
- [x] **BLACKOUT FUTURE AI** — Bot #3 released
- [x] **FUTURE SIGNAL AI** — Bot #4 released
- [x] **QX PERSONAL AI** — Bot #5 released
- [ ] Bots #6 through #10 — releasing progressively

### 🏗️ Bot Builder
- [x] Bot Builder button added to main menu
- [x] Full wizard — token verification, branding, module selection, template editing, button builder, review & deploy
- [x] Live deployment — real webhook registration, bot goes live instantly
- [x] My Bots management — start / stop / restart / delete
- [x] Early access released for INFINITY subscribers (1 bot per account)

### 💎 Telegram Premium Integration
- [x] User-account sender (own Telegram account)
- [x] Premium animated emojis in signals and checker
- [x] Secure browser WebApp login (2FA supported)
- [x] Premium lock/unlock per user (admin)
- [x] Token expiry (30 min for unused tokens)

### 👥 Community Features
- [x] Referral Program with unique per-user link
- [x] Referral milestone tracking
- [x] Promo code generation from referrals
- [x] Reviews & Ratings (star system + public average)

### 🗄️ Infrastructure
- [x] PostgreSQL database (upgraded from SQLite)
- [x] Connection pooling for concurrent users
- [x] Granular permissions (can_live, can_future, can_checker)
- [x] Ban cache & subscription cache (fast per-request checks)
- [x] Broadcast log history
- [x] Live payout menu (real-time % for all pairs)
- [x] Favorite pair list management

---

## ✅ v3.x — Tiered Subscriptions + Web Control

### 💳 Tiered Subscription System
- [x] Replaced flat license pricing with FREE / STARTER / PLUS / INFINITY tiers
- [x] Per-tier daily usage limits for Future Signal & Live Signal
- [x] Quota now counts only signals actually delivered, not scan attempts
- [x] "Upgrade" menu with live pricing and one-tap purchase link
- [x] Admin tools to grant/change any tier and duration, with instant user notification

### 🌐 Web Control Dashboard
- [x] Telegram Mini App — opens instantly using existing Telegram session
- [x] Live profile view (plan, credits, referral stats)
- [x] Timezone management for every signal type
- [x] Full template customization (Live Session & Live Signal)
- [x] One-tap referral link sharing
- [x] Gated to PLUS & INFINITY — FREE/STARTER see a view-only + upgrade prompt

### 🛠️ Admin Web Panel
- [x] Full user search & management from the browser
- [x] Licensed / expired subscriber views with in-place tier & duration editing
- [x] Role-based sub-admin presets (Co-Owner, Moderator, Sales, Support, Broadcaster)
- [x] Pair enable/disable toggle list
- [x] Promo code management, points, premium lock, broadcast

---

## ✅ v4.0 — Multi-Broker + Auto Payment + News Signal + Tools + Bot Builder Expansion

### 🏢 Multi-Broker Support
- [x] **Tradowix broker** — fully supported alongside Quotex
- [x] Broker selection in setup wizard
- [x] Per-broker pair support (OTC + Live)
- [x] Admin broker enable/disable toggle (Quotex, Tradowix)

### 💳 Auto Payment System
- [x] Binance Pay integration (ID: 1133439955) — auto-verified via Binance API
- [x] TRC20 USDT wallet — auto-verified via TronGrid API
- [x] BEP20 USDT wallet — auto-verified via BSC RPC
- [x] 60-minute payment expiry window
- [x] Amount tolerance for minor blockchain fee differences
- [x] Instant subscription activation — no manual approval needed
- [x] Self-serve flow entirely inside the bot

### 📰 News Signal System
- [x] Forex Factory economic calendar JSON feed integration
- [x] AI-powered direction analysis via Gemini (BULLISH / BEARISH / NEUTRAL)
- [x] Heuristic fallback (forecast vs previous, with inversion for negative metrics)
- [x] 30-day technical structure blend (trend + momentum)
- [x] Per-event analysis caching (expires at release time)
- [x] Filter by impact: HIGH / MEDIUM / LOW / All
- [x] Filter by days ahead: 1, 2, or 3 days
- [x] 29 supported pairs (major forex + XAU/USD)
- [x] Automatic CALL/PUT pair mapping from currency bias
- [x] Premium emoji formatted signal cards
- [x] Available as a standalone module and in Bot Builder

### 🔍 Signal Checker — 5th Mode Added
- [x] **Live Checker** — new checker mode for real/live market pairs
- [x] Full feature parity with OTC Checker (MTG, DOJI, payout filter, premium emoji)

### ⏱ Future Signal Modes — Expanded
- [x] **Live Market FS** — future signal sessions for live market pairs
- [x] **Blackout FS** — future signal sessions for blackout-style signals
- [x] **Whiteout FS** — future signal sessions for whiteout-style signals

### 🛠️ Signal Tools (New Category)
- [x] **Signal Formatter** — reformat any signal list into a clean card layout
- [ ] **Swap C/P** — flip all CALL/PUT directions in a pasted signal list *(button present, coming soon)*
- [x] **TZ Converter** — convert signal entry times to any other timezone
- [x] **Market Filters** — show which markets are currently stable

### 🏗️ Bot Builder — Major Expansion
- [x] PLUS plan: up to **3 bots** per account (previously 1)
- [x] INFINITY plan: up to **10 bots** per account (previously 1)
- [x] **Custom AI Prompt** per child bot — extra instruction for AI confirmation
- [x] **Notification Template** — customize default announcement text in Child Admin
- [x] **Child Admin Panel** — full admin panel for each deployed child bot
- [x] **Session Log Viewer** — real-time diagnostic log for sessions in child bots
- [x] All new modules selectable in Bot Builder (News Signal, Live Checker, Live FS, Blackout FS, Whiteout FS, Formatter, Market Filters, Swap C/P, TZ Converter)

### 📋 Session Log Store
- [x] `session_log_store.py` — shared in-memory session log module
- [x] Tracks scan / signal / reject / info events per session
- [x] Signal entries guaranteed never evicted (complete history)
- [x] General log capped at 20,000 entries
- [x] Web-based session log viewer (`session_log.html`)

### 🧠 Strategy Intelligence
- [x] `strategy_intelligence.html` — browser-based strategy intelligence dashboard
- [x] Accessible from Web Control / Admin Panel

---

## ✅ v5.2 — Q-BOT STUDIO Public Release *(18 October 2026)*

- [x] **Studio packages**: FREE (1 bot for everyone), LITE $30, PRO $55, ELITE $80 per month; yearly $300 / $550 / $800; INFINITY Studio bot
- [x] **9-step wizard** with a timezone step, review screen (DEPLOY / Back / CANCEL) and an animated ~4 s deploy
- [x] Chart templates (3), Live Signal / Live Result templates (3 each), Future / AXTIRON / News template sections
- [x] Buttons: BOLD / MONOSPACE font, premium emoji icons, **drag-and-drop home layout**
- [x] **Strategy per bot**: main-bot analyzers, 10 pre-made, 7 styles, custom mix, 20-indicator builder with editable values, ELITE 2 named strategies
- [x] Brokers per package, bot timezone, brand in the same font everywhere
- [x] **STUDIO CONTROL** web app: Overview, Brand, Features, Strategy, Texts, Buttons
- [x] FREE / INFINITY run cycles, rest notices, expiry reminders with RENEW
- [x] Full isolation of each bot's users, licences, data and strategy
- [x] Complete A → Z documentation: [STUDIO.md](STUDIO.md) · [guide/13-qbot-studio.md](guide/13-qbot-studio.md)

---

## ✅ v5.0 — 3 Brokers + Q-BOT STUDIO + Strategy Intelligence + 24/7 Performance

### 🏦 Three Fully Supported Brokers
- [x] **BINOLLA** added, alongside QUOTEX and TRADOWIX
- [x] Live market list loaded from the BINOLLA feed (new markets appear automatically)
- [x] **Primary Broker** setting: choose once, used in every feature
- [x] Broker-accurate pair lists, payouts, charts and results everywhere

### 🤖 Q-BOT STUDIO
- [x] Bot Builder rebuilt and renamed **Q-BOT STUDIO**
- [x] 8-step no-code creation wizard
- [x] **5 ready-made templates** each for Welcome, About and Help, with preview
- [x] 26 menu features (24 selectable now), button renaming and recolouring
- [x] Signal / result / chart / title customisation, premium emoji, custom AI prompt
- [x] Force channel join, open/licensed access mode
- [x] Child Admin Panel (Telegram + web), analytics, My Bots management
- [x] INFINITY: 1 bot with limited Studio features
- [x] **Separate Studio packages** and full public launch — see **v5.2** above

### 📘 Documentation
- [x] Complete step-by-step **User Guide** (13 chapters): every menu, step and button, with plan availability

### 🧠 Strategy Intelligence (rebuilt)
- [x] Per-analyzer learning per market, timeframe and hour
- [x] Conservative (confidence-adjusted) ranking of results
- [x] Setup preference only when one setup is clearly better
- [x] Smart routing to a clearly better analyzer (admin toggle)
- [x] Safe auto-tuning with hard limits and one-tap reset
- [x] Recommended analyzer from the strongest proven record

### 📡 Scanning Mode
- [x] Shared supply/demand zone and trendline scanner across all open markets
- [x] Zone rejection, trendline rejection, break & retest, confirmed zone-break retest
- [x] Accurate levels: broken zones discarded, clean trendlines only
- [x] Signal charts show the exact zone/trendline used
- [x] Optional MTF confirmation, M1–M5, Live Session and Live Signal Auto
- [x] Per-signal statistics (`/scanstats`)

### ⚡ Performance & Stability
- [x] Analysis engine about 14× faster, candle reading about 6× faster
- [x] Instant button responses and parallel handling of user taps
- [x] Web apps on separate worker loops
- [x] Self-healing scanners and result tracking
- [x] 24/7 launcher with automatic restart and a freeze watchdog
- [x] Bounded memory and automatic cleanup for weeks of uptime

### 🌐 New Apps & Features
- [x] **QUANTEX HUB**: community feed, messages, leaderboards, news, breaking-news alerts
- [x] **Live Chart**: all brokers, M1 → D1, 30-day history
- [x] **AXTIRON FS**: advanced future signal generator (M1–M15, 1–5 h)
- [x] **AI Filter**: filter future lists against 1–30 days of history
- [x] **Group Live Signal**: Live Signal inside Telegram groups

---

## ✅ v5.1 — Website + Developer API Platform

### 🌐 Website — [quantexbot.pro](https://quantexbot.pro)
- [x] Public website in **English, বাংলা and Português** (more languages from the admin panel)
- [x] Feature pages, brokers, Live Chart preview, pricing, documentation, updates, FAQ, rules, terms, privacy, contact
- [x] Accounts: email or Google sign-up, email verification, **two-step verification**, session management, notifications, profile photo, Telegram link
- [x] User dashboard (with a slide-in menu on phones): profile, security, notifications, settings, API pages, billing
- [x] Content management: Markdown editor, drafts, preview, publishing, version history
- [x] **QUANTEX AI** support assistant on every page (3 languages, own knowledge base, account-aware, hand-off to support)
- [x] Admin panel: users, payments, subscriptions, API keys / usage / logs, content, AI support, roles, audit log, analytics dashboard

### 💳 Billing
- [x] Developer API plans (Developer free, Starter, Pro, Business) bought on the website
- [x] Binance Pay, USDT TRC20 and USDT BEP20 with **automatic verification** (unique amount, exact receiver, confirmations, one-time transaction IDs shared with the bot)
- [x] Receipts, renew / upgrade, reminders 7 days and 1 day before the end

### 🔌 Developer API — [api.quantexbot.pro/v1](https://quantexbot.pro/docs/api)
- [x] API keys (hash only, scopes, IP allow-list, expiry, rotate, revoke), per-minute and monthly limits per plan
- [x] Brokers, pairs, payouts, **OHLC candles M1–H4** (closed candles, activity volume, payout), **signal checker**, **economic news** with bias
- [x] **Live signals and results** (`/v1/signals/live`, `/v1/results`) — every signal the bot delivers, once, with its result
- [x] **Webhooks** (signed, retries 1 / 5 / 30 min) and a **Server-Sent Events stream**
- [x] **Future signal lists** as async jobs (OTC, Live, Blackout, Whiteout)
- [x] Usage and request logs in the dashboard; OpenAPI 3.1; documentation open to AI assistants (`/llms.txt`)

### 🤖 Auto Trading — v5.3 *(22 Oct 2026)*
- [x] AUTO TRADING mini app in the Telegram bot (PLUS & INFINITY): broker picker with logos, sign-in with the broker email (remembered per broker) and password
- [x] QUOTEX, TRADOWIX and BINOLLA; password never stored, encrypted session; reconnects by itself in the background
- [x] Live Signal, Live Session and own future lists (OTC, Live, Blackout, Whiteout) traded at the exact entry time
- [x] Stake (USD / %), martingale, QUANTEX Recovery plan with money-management sheet
- [x] Stop loss / take profit auto stop, safety margin (+ on MTG), payout filter, max trades at once, signals per day
- [x] Dashboard, terminal log, history with amount / payout / result, Telegram notifications

### 🟢 System Status
- [x] Health checks every minute (website, API, database, data engine, Telegram bot, payments)
- [x] Public status page with 90-day uptime and incidents; `/v1/status` JSON

---

## 🔜 Phase 6 — Short Term

### Multiple Broker Support — Phase 2
- [ ] **Pocket Option** — full signal and broadcast support
- [ ] **Olymp Trade** — OTC and Live pair support
- [ ] **Binomo** — OTC support

### Q-BOT STUDIO — Next
- [ ] Nested multi-level menu builder
- [ ] Logo/banner upload & full theming
- [ ] More Welcome / About / Help templates
- [ ] More Future / AXTIRON / News templates
- [ ] REFERRAL feature for Studio bots

### Free Bots Mission — Phase 2
- [ ] Bot #6 release
- [ ] Bot #7 release
- [ ] Bot #8 release
- [ ] Bot #9 release
- [ ] Bot #10 release

---

## 🔮 Phase 7 — Medium Term

### Enhanced AI Capabilities
- [ ] Upgraded AI models for deeper analysis
- [ ] Sentiment Analysis — market sentiment scoring
- [ ] Pattern detection layer

### Advanced Signal Management
- [ ] Signal history archive per user
- [ ] Personal win-rate statistics dashboard
- [ ] Personal pair-specific and time-of-day performance view

---

## 🚀 Phase 8 — Long Term

### Auto Trading System
- [ ] Quotex API direct trade execution
- [ ] Pocket Option API integration
- [ ] Risk management engine (auto stake sizing)
- [ ] Drawdown protection (auto-stop on daily loss limit)
- [ ] Auto compounding

### Mobile Application
- [ ] Native Android app
- [ ] Native iOS app
- [ ] Push notifications for signals

### Multi-Language Support
> The website already speaks English, বাংলা and Português; this item is for the Telegram bot.
- [ ] Bengali (বাংলা)
- [ ] Arabic (عربي)
- [ ] Spanish (Español)
- [ ] Hindi (हिंदी)
- [ ] Indonesian (Bahasa Indonesia)

---

## 📊 Version History

| Version | Highlights |
|---|---|
| **v5.3** | **Auto Trading (22 Oct 2026)**: the bot trades the signals on the user's own QUOTEX / TRADOWIX / BINOLLA account — encrypted session (password never stored), martingale & QUANTEX Recovery, stop loss / take profit auto stop, safety margin, payout filter, max trades at once, log & history; HYBRID ENGINE V3 analyzer; Developer API focused on market data (candles, history, ticks; signal endpoints paused) |
| **v5.2** | **Q-BOT STUDIO public release (18 Oct 2026)**: FREE / LITE / PRO / ELITE packages, 9-step wizard with animated deploy, per-bot strategies (pre-made, styles, custom, 20-indicator builder), chart / signal / result templates, drag-and-drop buttons, STUDIO CONTROL web app |
| **v5.1** | Website [quantexbot.pro](https://quantexbot.pro) (3 languages, accounts, dashboard, AI support), Developer API with live signals + results, webhooks, SSE stream, future signal jobs, candles, checker, news; automatic USDT / Binance Pay billing; public status page; admin analytics |
| **v5.0** | 3 brokers (BINOLLA added) + Primary Broker, Q-BOT STUDIO with templates, rebuilt Strategy Intelligence, Scanning Mode with accurate zones/trendlines, ~14× faster engine + 24/7 self-healing runtime, QUANTEX HUB, Live Chart, AXTIRON FS, AI Filter, Group Live Signal |
| **v4.0** | Tradowix broker support, Auto Payment (Binance Pay/TRC20/BEP20), News Signal System (Forex Factory + AI), Live Checker (5th checker mode), Signal Tools (Formatter/Swap C/P/TZ Converter/Market Filters), new Future Signal modes (Live/Blackout/Whiteout FS), Bot Builder expanded (PLUS: 3 bots, INFINITY: 10 bots; Custom AI Prompt; Child Admin Panel; Session Log Viewer), Strategy Intelligence dashboard |
| **v3.x** | Tiered subscriptions (STARTER/PLUS/INFINITY), Web Control dashboard, Admin Web Panel with role-based sub-admins, Bot Builder early access (live deployment) |
| **v3.0** | AI confirmation, Live broadcast, Future Live system, 4-mode checker suite (super-fast + 100% accurate), Free Bots (5 released), Bot Builder button, PostgreSQL, referrals, reviews, premium emojis |
| **v2.0** | Full bot manager, MTG, charts, sleep mode, scheduler, future engine, checker |
| **v1.x** | Core signal engine, basic Telegram integration |

---

## 💡 Feature Requests

- **Telegram**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro) — all updates are posted here first
- **Channel**: [@Quantexbot1](https://t.me/Quantexbot1)
- **Community Group**: [t.me/quantexlounge](https://t.me/quantexlounge)
- **Email**: [quantexbotsupport@gmail.com](mailto:quantexbotsupport@gmail.com)

*Roadmap subject to change based on user feedback.*
