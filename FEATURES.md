# 🔮 QUANTEX-BOT v5 — Complete Feature Documentation

> **Official Telegram Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)  
> **Developer**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)

---

## 📋 Feature Index

1. [Supported Brokers (QUOTEX · TRADOWIX · BINOLLA)](#1-supported-brokers)
2. [Signal Engines — Strategy Mode & Scanning Mode](#2-signal-engines--strategy-mode--scanning-mode)
3. [Strategy Intelligence](#3-strategy-intelligence)
4. [Live Session](#4-live-session)
5. [AI-Assisted Live Signal](#5-ai-assisted-live-signal)
6. [Signal Checker — Full Suite](#6-signal-checker--full-suite)
7. [Future Signals (OTC · Live · Blackout · Whiteout · Future Live)](#7-future-signals)
8. [AXTIRON FS](#8-axtiron-fs)
9. [AI Filter](#9-ai-filter)
10. [News Signal System](#10-news-signal-system)
11. [Signal Tools & Live Payouts](#11-signal-tools--live-payouts)
12. [MTG (Martingale) System](#12-mtg-martingale-system)
13. [Chart Generation](#13-chart-generation)
14. [Q-BOT STUDIO — Build Your Own Bot](#14-q-bot-studio--build-your-own-bot)
15. [QUANTEX HUB](#15-quantex-hub)
16. [Live Chart](#16-live-chart)
17. [Web Control Dashboard](#17-web-control-dashboard)
18. [Session Log Viewer](#18-session-log-viewer)
19. [Telegram Premium Integration](#19-telegram-premium-integration)
20. [Free Bots Mission](#20-free-bots-mission)
21. [Auto Payment System](#21-auto-payment-system)
22. [Subscription & Access System](#22-subscription--access-system)
23. [Points & Quota System](#23-points--quota-system)
24. [Scheduled Sessions & Partial Reports](#24-scheduled-sessions--partial-reports)
25. [Referral Program, Reviews & History](#25-referral-program-reviews--history)
26. [Performance & 24/7 Stability](#26-performance--247-stability)
27. [Admin Control Panel](#27-admin-control-panel)
28. [Database — PostgreSQL Backend](#28-database--postgresql-backend)

---

## 1. Supported Brokers

QUANTEX-BOT fully supports **three brokers**. Each has its own live candle feed, payout data and result checking.

| Broker | OTC | Live | Total |
|---|---|---|---|
| 🟦 **QUOTEX** | 62 | 28 | **90** |
| 🟧 **TRADOWIX** | 101 | 15 | **116** |
| 🟪 **BINOLLA** | 104 | 17 | **121** |

- **Every feature works on every broker**: Live Session, Live Signal (both engines), all Checkers, all Future Signal modes, AXTIRON FS, AI Filter, Live Payouts, Market Filters and the Live Chart.
- **Broker selection**: each feature asks which broker you trade on. You can also set a **Primary Broker** (*Settings → Primary Broker*) and turn on **"Use this broker in all features"** so it is never asked again.
- **Broker-accurate markets**: lists, payouts, charts and signals always follow the selected broker.
- **BINOLLA** markets are loaded live from the BINOLLA feed, so new markets appear automatically. BINOLLA results are settled from the closed candle.

📋 **The complete market list for every broker, with names and counts, is in [SUPPORTED_MARKETS.md](SUPPORTED_MARKETS.md).**

---

## 2. Signal Engines — Strategy Mode & Scanning Mode

When you start **Live Session** or **Live Signal → Auto**, you choose between two independent engines (the admin decides which are available).

### ⚛️ Strategy Mode — three analyzers

| Analyzer | Focus |
|---|---|
| **QUANTUM SCAN** | Dynamic MTF + market structure + practical signals. Trend-continuation only. |
| **SMART FOCUS** | Focuses on the best-quality markets, with defended level and tick-pressure confirmation |
| **HYBRID ENGINE** | MTF + structure + trap detection. Takes continuation and properly confirmed reversals. |

Under the hood, 20+ independent analysis modules score each setup: Trend Continuation, Break of Structure, Change of Character, Engulfing Reversal, MACD Cross, RSI Divergence, Bollinger Breakout, Pin Bar, MTF Confluence, VWAP Reversion, Ichimoku, Fibonacci Pullback, candlestick patterns (Harami, Morning/Evening Star, Tweezer, Three Black Crows), Supertrend + PSAR, CCI Extreme and Multi-Indicator Confluence. A signal must then pass:

- a **confidence score** threshold (each analyzer has Normal / Standard / Hard presets),
- a **final closed-candle quality filter** (doji, wickless, abnormal-range and similar checks),
- a **primary trend gate** (Quantum and Smart Focus),
- and the admin's **signal controls** (enabled confirmation timeframes and setup types).

### 📡 Scanning Mode — shared zone & trendline scanner

One shared scanner watches **every open market of the broker at once**, continuously, and publishes a signal the moment a confirmed setup appears. Every subscriber receives the same signal at the same time.

| Setup | Description |
|---|---|
| **Supply / Demand Rejection** | Price taps a confirmed zone and rejects it with a strong wick |
| **Trendline Rejection** | Price rejects a clean, unbroken trendline in a trending market |
| **Trendline Break & Retest** | Price breaks a trendline, then retests it from the other side |
| **Zone Break Confirmed Retest** | A zone breaks, 1–2 pullback candles follow, then a retest confirms the break |

**Accurate level drawing (v5.0):**
- Zones are built from clustered swing points, and each touch is counted once (a flat top is one touch, not two).
- A zone that a later candle has **closed through** is treated as broken and is no longer used as supply/demand.
- A trendline must have well-separated anchors, and **no candle may close through it** between them. A line broken after its second anchor is marked broken: it is not used for rejections, only for break/retest.
- Signals never trade into an intact opposing zone or trendline.
- The signal chart shows **the exact zone or trendline** the signal came from as its support/resistance.

**Options:** M1 / M2 / M3 / M5 timeframes, optional higher-timeframe confirmation (M2–M15), payout ≥ 80% only, at most 2 signals per minute, and a 4-minute cooldown per market.

---

## 3. Strategy Intelligence

Strategy Intelligence is the layer that makes QUANTEX-BOT **better the longer it runs**. Every settled signal (WIN / MTG WIN / LOSS / DOJI) is stored with the analyzer that produced it, the market, timeframe, broker, hour and setup type (continuation or reversal). That history drives these decisions:

| Capability | How it works |
|---|---|
| **Per-analyzer learning** | Each analyzer is judged on **its own** record on each market. Results of different analyzers are never mixed. |
| **Hour → market → broker fallback** | It first looks at the same market at the same hour, then the whole market, then the whole broker, using the most specific scope with enough data |
| **Conservative scoring** | Win rates are ranked with a confidence-adjusted score, so 8 wins from 10 trades cannot outrank a proven 300-trade record |
| **Setup preference** | If continuation clearly beats reversal on a market (by 10+ points, or the other side wins under 45%), the weaker setup is skipped there. Otherwise both are allowed. |
| **Market ranking** | Markets with a strong record are scanned first. Markets that are clearly failing are skipped. |
| **Smart routing** | If the selected analyzer has 20+ results on a market and another analyzer is clearly better there (20+ results, at least 8 points higher, conservative win rate ≥ 50%), that market is analysed by the better analyzer. Admin switch: `/intelrouting on/off`. |
| **Safe auto-tuning** | When an analyzer keeps losing on a market (20+ results, win rate under 55%), one extra safety filter is switched on for that market, with at most 3 automatic changes. Admin reset: `/autotunereset` (a backup is kept). |
| **Recommended analyzer** | The analyzer menu marks the analyzer with the strongest proven 30-day record (minimum 20 results) as **RECOMMENDED** |
| **Scanning Mode statistics** | Every Scanning Mode signal is recorded with its setup, score, zone touches, hold time and result. Admins can review win rate by setup, score, zone touches, pair and hour with `/scanstats [days]`. |

The **Strategy Intelligence dashboard** in the Admin Web Panel shows win rates per analyzer, market, timeframe, hour and setup type, plus per-market *auto/manual* control and the audit log of every change.

---

## 4. Live Session

A continuous signal session that keeps scanning and posting to your channel or group until you stop it. **Requires a paid plan (STARTER, PLUS or INFINITY)**; its signals share the daily allowance with Live Signal.

**Setup wizard:** broker → channel / group → username → message style (Premium or Normal emoji) → market (OTC / Live / All) → Avoid under 80% or manual → engine (Strategy Mode analyzer or Scanning Mode) → pairs → timeframe (**M1, M2, M3, M5, M10, M15**) → charts → partial report interval → review & launch. Every button is explained in the [User Guide](guide/02-live-session.md).

- Signals arrive at the start of the next candle of your timeframe, with entry time, direction, confidence, payout and chart
- Results are checked after the candle closes, with automatic MTG on a loss
- **Session Status**, **Send Partial** and **Stop Session** controls
- Real-time **Session Log** in the web app
- Saved setups can be re-run or scheduled

---

## 5. AI-Assisted Live Signal

### Manual Signal
Choose a market and timeframe and receive one **AI-confirmed** signal on demand.

### Auto Signal
The bot scans all markets (or your filter: OTC, Live, Avoid under 80%, or manual selection) and sends the strongest setups automatically, in **Strategy Mode** or **Scanning Mode**.

### Group Live Signal
The **bot owner** (in practice, the owner of a Q-BOT STUDIO bot) adds the bot to a Telegram group as an admin and sends `/start_live_signal`. Live Signal then runs **inside the group**, with owner-only controls for start, stop, status and partial reports.

### What each Live Signal includes
- Direction, entry time and timeframe
- **Live broker payout %**
- **Support & Resistance** (in Scanning Mode, the exact zone or trendline the signal came from)
- **AI confirmation** with a confidence level and a short written reason (Strategy Mode)
- A professional signal chart, and a result chart after the candle closes
- Daily quota display and custom templates (header, owner name, branding)

```
📊 LIVE SIGNAL
━━━━━━━━━━━━━━━━━━━━
Pair         : EUR/USD OTC
Direction    : ⬆️ BUY (CALL)
Entry Time   : 14:35
Payout       : 87%
Support      : 1.0821
Resistance   : 1.0847
━━━━━━━━━━━━━━━━━━━━
🤖 Strong upward momentum confirmed
at support zone. Entry validated.
```

---

## 6. Signal Checker — Full Suite

QUANTEX-BOT features a, **super-fast, 100% accurate** signal checking suite with five checker modes.

### ⚡ Super-Fast & 100% Accurate
- **Local candle cache system** — candle data stored locally for near-instant lookup
- **O(1) time index** — pre-built HH:MM → candle index map eliminates sequential searching
- **File-level cache** — JSON candle files cached in memory, only re-read when file changes
- **Archive + recent data** — checks both today's live data and historical archive files
- **100% accurate results** — direct candle close/open comparison, no estimation

### 🔍 Checker Modes

#### 1. Live Checker
Signal checker for **real/live market pairs** — identical accuracy and feature set as OTC Checker but applied to live forex pairs.
- Paste live market signals → instant WIN/LOSS per signal
- Full MTG breakdown and DOJI detection
- Premium emoji formatted output

#### 2. OTC Checker
Standard binary options signal checker for OTC pairs.
- Paste signals → instant WIN/LOSS per signal
- Supports unlimited signals per check
- Real payout data per signal slot
- MTG result shown with superscript level (WIN¹, WIN², etc.)
- DOJI candles handled and displayed separately

#### 3. Blackout Checker
A special checker mode for **Blackout-style signals** (signals with no direction).
- Determines direction automatically from the **previous candle** color
- Previous GREEN candle → expected direction: PUT
- Previous RED candle → expected direction: BUY
- DOJI previous candle → result shown as `[doji]`
- Checks entry candle + MTG steps against expected direction

#### 4. Whiteout Checker
Similar to Blackout but uses the **same-direction** logic from the previous candle.
- Previous GREEN candle → expected direction: BUY
- Previous RED candle → expected direction: PUT
- All other logic identical to Blackout checker

#### 5. Custom Date Checker
Check signals for **any specific date**, not just today/yesterday.
- Enter any past date
- Bot fetches archived candle data for that date
- Full WIN/LOSS report for the chosen date
- Works across all checker modes (OTC, Live, Blackout, Whiteout)

### 📋 Checker Features (All Modes)
| Feature | Description |
|---|---|
| **Universal Signal Parser** | Parses signals from ANY source, ANY format — automatically |
| **Unicode Normalizer** | Converts fancy/bold/italic Unicode characters to standard ASCII before parsing |
| **Pair Alias Map** | Auto-normalizes 100+ pair name variants to canonical names |
| **All Brokers** | Works with QUOTEX, TRADOWIX and BINOLLA markets (300+ in total) |
| **DOJI Detection** | DOJI candles detected and reported separately (not counted as WIN or LOSS) |
| **Payout Filter** | Filter signals below a set payout threshold — flagged with payout % |
| **BD Timezone** | Bangladesh timezone (UTC+6) for accurate time-based matching |
| **Today / Yesterday / Custom Date** | Check results for any date |
| **MTG Breakdown** | Shows exact MTG level for each WIN (WIN¹ = MTG1, WIN² = MTG2, etc.) |
| **Premium Emoji Output** | Results formatted with Telegram Premium animated emojis (if enabled) |
| **No-Data Handling** | Signals with no candle data reported as ❓ and excluded from win-rate |

### Output Report
```
▰▱▱ 𝚀𝚄𝙰𝙽𝚃𝙴𝚇 𝙱𝙾𝚃 𝙲𝙷𝙴𝙲𝙺𝙴𝚁 ▱▱▰
━━━━━━━━━━━ • ━━━━━━━━━━━
M1 EURUSD_OTC  14:35 BUY  ✅
M1 GBPUSD_OTC  15:00 SELL ✅¹
M1 AUDUSD_OTC  15:35 BUY  ✖️
M1 USDJPY_OTC  16:00 PUT  ⚖️ (doji)
━━━━━━━━━━━ • ━━━━━━━━━━━
🏆 Total : 4
✅ Win   : 2
✖️ Loss  : 1
```

---

## 7. Future Signals

| Mode | Description |
|---|---|
| **OTC Market FS** | Generates a future signal list for OTC markets over your chosen time window |
| **Live Market FS** | The same for live markets |
| **Blackout FS** | Future list for blackout-style (reverse previous candle) trading |
| **Whiteout FS** | Future list for whiteout-style (follow previous candle) trading |
| **Future Live** | Paste your own signal list and each signal is posted at its exact time, then checked automatically |

### Future Live — how it works
1. **Paste** a signal list in any format:
```
▢ 05:50 USDIDR ⇨OTC ☞ PUT
❒ USDCAD-OTC ☞ 05:53 ⊱ PUT
M1 EURUSD_OTC 06:00 BUY
```
2. **Choose** where signals go (DM or channel)
3. **Choose** MTG mode: MTG 1, MTG 2 or Non-MTG
4. **Preview** the template (header, username), then start
5. Each signal is posted at its minute, the result is checked after the candle closes, and a final WIN/LOSS summary is sent

During a session you can view the remaining signals and the next one, see a countdown, and stop with one tap. Free users get **3 Future Live sessions**. Subscribers get unlimited sessions.

---

## 8. AXTIRON FS

A new **advanced Future Signal generator**.

- **OTC or Live** markets of your broker, choosing from open markets only
- **Timeframes**: M1, M2, M3, M5, M10, M15
- **Duration**: 1 to 5 hours of signals
- Settings are remembered per user
- Daily allowance per plan (STARTER 3 · PLUS 10 · INFINITY unlimited)

---

## 9. AI Filter

Clean up any future-signal list before you trade it.

1. Choose the list type: **Normal OTC, Normal Live, Blackout or Whiteout**
2. Paste or upload your list, or tap **Filter** straight after generating an FS list
3. Choose the history range: **1–7, 7–15 or 15–30 days**
4. Each signal is scored against how that market behaved at that time in the past, and the strongest entries are returned as a new list. Your original list is not changed.

---

## 10. News Signal System

AI-powered trading signals derived from the Forex Factory **economic calendar**.

### How It Works

**Step 1 — Calendar Fetch**  
QUANTEX-BOT pulls live economic event data from the Forex Factory JSON feed. No Selenium, no scraping — reliable structured data.

**Step 2 — Filter Events**  
Events are filtered by:
- **Impact Level** — HIGH, MEDIUM, LOW, or All
- **Day Range** — events for the next 1, 2, or 3 days ahead
- **Currency** — only currencies relevant to your selected trading pairs

**Step 3 — AI Direction Analysis**  
Each event is sent to the Gemini AI model, which assigns:
- **BULLISH** or **BEARISH** bias for the event currency
- **Confidence score** (60–95%)
- **Rationale** — 1–2 sentence explanation

**Step 4 — Heuristic Blend**  
If AI analysis is unavailable, a built-in heuristic engine derives bias from `forecast vs previous` (with inversion logic for unemployment, jobless claims, etc.).

**Step 5 — Technical Structure Blend**  
A lightweight 30-day technical read (trend + momentum) is blended with the fundamental bias. Agreement boosts confidence; disagreement reduces it.

**Step 6 — CALL/PUT Pair Mapping**  
The currency bias is automatically mapped to CALL and PUT recommendations across all your selected pairs:
- Currency BULLISH → CALL on base pairs, PUT on quote pairs
- Currency BEARISH → PUT on base pairs, CALL on quote pairs

### Supported Pairs — 29 Pairs
```
EUR/USD · GBP/USD · USD/JPY · USD/CHF · AUD/USD · USD/CAD · NZD/USD
EUR/GBP · EUR/JPY · EUR/CHF · EUR/AUD · EUR/CAD · EUR/NZD
GBP/JPY · GBP/CHF · GBP/AUD · GBP/CAD · GBP/NZD
AUD/JPY · AUD/CHF · AUD/CAD · AUD/NZD
CAD/JPY · CAD/CHF · CHF/JPY
NZD/JPY · NZD/CHF · NZD/CAD
XAU/USD
```

### Features
- Caches analysis results per event — first user pays the AI cost, everyone else gets it instantly
- Analysis expires after the event's release time to ensure freshness
- Formatted with premium emoji signal cards
- Available in the main bot and as a selectable feature in Q-BOT STUDIO bots

---

## 11. Signal Tools & Live Payouts

| Tool | Description |
|---|---|
| **Formatter** | Paste any signal list and get it back as a clean, standardised card |
| **Swap C/P** | Flip every CALL ↔ PUT in a pasted list *(coming soon)* |
| **TZ Converter** | 3-step converter: source timezone → target timezone → paste the list |
| **Market Filters** | Choose OTC or Live and see which markets are stable and tradeable right now |
| **Live Payouts** | Live payout % for every OTC and Live market of your broker |

---

## 12. MTG (Martingale) System

If the first signal results in a LOSS, QUANTEX-BOT activates a **Martingale recovery trade**.

- MTG 1 — one recovery step
- MTG 2 — two recovery steps (double recovery)
- Non-MTG — no recovery (single signal only)
- Results tracked as: WIN, WIN¹ (MTG1 win), WIN² (MTG2 win), LOSS
- In Future Live mode, MTG fires automatically at the next candle minute

---

## 13. Chart Generation

Every signal includes a professional candlestick chart.

### Signal Chart
- Recent candles with entry point marked
- Direction color coding (green = BUY, red = SELL)
- Proprietary indicator overlays
- Session win/loss statistics

### Live Signal Chart
- Dedicated chart for Live Signal / channel broadcast mode
- Support & Resistance levels marked (in Scanning Mode: the exact zone/trendline used)

### Result Chart
- WIN/LOSS result overlay
- MTG entries annotated
- DOJI candle shown in amber color

---

## 14. Q-BOT STUDIO — Build Your Own Bot

> 🟢 **Released 18 October 2026 (v1.0).** Release notes: [STUDIO.md](STUDIO.md) · Complete A → Z manual: [guide/13-qbot-studio.md](guide/13-qbot-studio.md)

**Build, brand and run your own Telegram signal bot, with no coding and no experience needed.** Your bot runs on the QUANTEX engine, so you need no server, hosting or technical setup.

### Packages
| Package | Price | Bots | Brokers | Features | Strategy |
|---|---|---|---|---|---|
| 🆓 **FREE** | $0 | 1 | QUOTEX | 2 | Main bot (1 analyzer) · runs 7 days every 30 days, 4h on / 2h off |
| 👑 **INFINITY** | Included with Bot Access INFINITY | 1 | QUOTEX | 9 | Main bot (1 analyzer) · 6h on / 2h off |
| 🟢 **LITE** | $30 / month · $300 / year | 1 | QUOTEX | 14 | Main bot (2) + 10 pre-made |
| 🔵 **PRO** | $55 / month · $550 / year | 3 | Any 2 | 19 | Main bot (3) + pre-made + 7 styles + custom mix |
| 👑 **ELITE** | $80 / month · $800 / year | 5 | All 3 | 22 | Everything + 20-indicator builder + 2 named strategies |

FREE, INFINITY and LITE stay on TEMPLATE 01 for message and chart templates. PRO and ELITE unlock every template. Details: [PRICING.md](PRICING.md#-q-bot-studio-packages).

### The 9-step creation wizard
| Step | What you do |
|---|---|
| **1 · Bot Token** | Create a bot with @BotFather (`/newbot`) and paste its token. It is checked privately and your message is deleted |
| **2 · Brand Name** | The name shown across your bot (max 32), replacing QUANTEX in the same font |
| **3 · Support Account** | Your `@username`, **USE MY PROFILE USERNAME** or **SKIP** |
| **4 · Timezone** | The UTC offset every time in your bot uses |
| **5 · Welcome** | One of **5 templates**, preview → **CONFIRM** |
| **6 · About** | One of **5 templates**, preview → **CONFIRM** |
| **7 · Help** | One of **5 templates**, preview → **CONFIRM** |
| **8 · Features** | Tick the features that become menu buttons (6 groups, package-limited) |
| **9 · Force Join** | **ENABLE** (your channel) or **SKIP** |
| **Review** | **DEPLOY** · **Back** · **CANCEL**. A ~4-second animated deploy, then **YOUR BOT IS LIVE** |

### Features you can give your bot (22)
- **Core**: Start Live Session, Schedule Session
- **Checkers**: Live Checker, OTC Checker, Blackout Checker, Whiteout Checker
- **Future Signals**: OTC Market FS, Live Market FS, Blackout FS, Whiteout FS, Future Live
- **Signals**: Live Signal, Live Payouts, News Signal
- **Tools**: Formatter, Market Filters, Swap C/P, TZ Converter
- **User**: My Profile, About, Reviews, Help *(Referral coming soon)*

### Customise everything after deployment (MY BOTS → CUSTOMIZE)
- Welcome / About / Help templates, support account, brand, timezone, brokers, force join
- **Buttons**: name, colour, BOLD / MONOSPACE font, premium emoji icon, reset
- **Chart templates** (CLASSIC QUANTUM · AI TERMINAL · PULSE PRO) with your watermark
- **Live Signal / Live Result templates** (3 each, shared by Live Signal and Live Session)
- **Future Signal, AXTIRON FS and News Signal** templates
- **STUDIO CONTROL** web app: Overview, Brand, Features, **Strategy**, Texts, **Buttons** (drag-and-drop home layout)
- Change token, start / stop, analytics, delete

### Strategy per bot
Main-bot analyzers (QUANTUM SCAN, SMART FOCUS, HYBRID ENGINE, Hybrid Engine V2 Astra, QUANTEX TURBO), 10 pre-made strategies, 7 trading styles, a custom 5-indicator mix and a **20-indicator builder with editable values** and an "at least N agree" rule. ELITE runs **two named strategies** at once. Each bot's strategy and cooldowns belong to that bot only.

### Run your bot like a business
- **Admin panel** (`/admin` in your bot + Admin Web): users, licences (7 / 30 days / permanent), bans, broadcasts, stats, logs, usage reset and daily limits per tier
- **Access mode**: *open* (anyone can use it) or *licensed* (only users you license)
- **Analytics**: users, active today, actions and signals per bot
- **Full isolation**: your bot's users, licences, data and strategy are never mixed with the main bot or other bots

---

## 15. QUANTEX HUB

A full trading community inside Telegram (Mini App).

- **Feed**: text and image posts with up to 5 tags, likes, comments, shares and views
- **Trending topics** from the most-used tags
- **Profiles** with avatar, cover, stats (posts, likes, comments, views) and the user's QUANTEX bots
- **Direct messages**: private conversations with pin, delete and clear
- **Leaderboards**: top traders and top bot developers (Q-BOT STUDIO builders)
- **Market News**: the daily economic calendar with bias, call/put pairs and entry time, plus **breaking-news alerts** for high-impact events
- **Notifications** and reporting tools for a safe community

---

## 16. Live Chart

A professional candlestick chart for **every market of all three brokers**, opened as a Telegram Mini App.

- Timeframes **M1, M2, M3, M5, M10, M15, M20, M25, M30, M35, M40, M45, H1, H4, D1**
- Up to **30 days** of history, with live price updates
- Broker switcher (QUOTEX / TRADOWIX / BINOLLA) and a full market picker with payout and open/closed status

---

## 17. Web Control Dashboard

A browser-based control panel for your account, available directly inside Telegram as a **Mini App** — no separate website login required, it opens using your existing Telegram session.

### Who Can Access It
| Tier | Access Level |
|---|---|
| 🆓 FREE / 🟢 STARTER | View-only — profile, plan status, and pricing |
| 💎 PLUS / 👑 INFINITY | Full control — every feature below |

### What You Can Do
- **Live Profile** — see your current plan, daily signal credits used/remaining, and referral stats in real time
- **Timezone Management** — set the clock offset for every signal type from one screen, with instant live preview
- **Template Customization** — visually edit your Live Session and Live Signal message templates (titles, chart labels, watermark, footer)
- **Referral Sharing** — copy or share your referral link with one tap
- **Upgrade / Pricing** — see all subscription tiers and a direct link to purchase or change plans

### Security
- Authenticated using Telegram's own signed session data — no separate password to create or remember
- All changes sync instantly with the bot itself

---

## 18. Session Log Viewer

A real-time **diagnostic log** for every active live signal session.

### What It Tracks
Every event in the signal loop is logged in real time:
- **Scan** — each pair scanned (pair name + timestamp)
- **Signal** — every signal generated (pair, direction, time)
- **Reject** — pairs that failed the confidence filter (with reason)
- **Info** — general session events (start, stop, resume)

### Storage Design
- Implemented in `session_log_store.py` — a lightweight shared in-memory module
- Log is scoped to **one active session per user** — automatically cleared when the session stops
- The latest 5,000 signal entries and 5,000 general entries are kept per session, so memory stays flat even in sessions that run for weeks

### Access
- Accessible from the **Web Control Dashboard** and from the **Q-BOT STUDIO Child Admin Panel**
- Reopening the log page shows the full accumulated history without missing entries
- Available to the main bot owner and to Q-BOT STUDIO bot owners

---

## 19. Telegram Premium Integration

Connect your Telegram account to unlock **Premium Emoji** signal formatting.

### How It Works
1. Open **OTHERS** in the main menu
2. Tap **Login**
3. Secure browser-based login opens (WebApp)
4. Enter credentials and phone number
5. Enter verification code + optional 2FA
6. Connected — Premium mode active (check anytime with **TG Status**)

### What It Unlocks
- Animated premium emojis in signal and checker outputs
- Signals sent via your own Telegram account
- Richer, more visually distinctive formatting

### Security
- Encrypted session storage with auto-reconnection
- 2FA fully supported
- Login links expire automatically
- Admin can lock/unlock premium per user

---

## 20. Free Bots Mission

**"10 Powerful Premium Bots — 100% FREE"**

Five free tools are already released for every QUANTEX user, and the rest will follow step by step.

| # | Bot | Description |
|---|---|---|
| 01 | 🚀 **HUNTER X QUANTEX** | Advanced live signal software: real-time signals, automatic result tracking, bad-market filter, multi-pair analysis |
| 02 | 🐉 **DRAGON X QUANTEX** | Live OTC Signal Pro: instant UP/DOWN signals, entry timer and confidence levels |
| 03 | 🖤 **BLACKOUT FUTURE AI** | Advanced future signal system: AI engine, smart pair and time selection, real-time + historical data |
| 04 | 🔮 **FUTURE SIGNAL AI** | AI-confirmed future signals with real-time + historical analysis and smart multi-pair selection |
| 05 | 🧠 **QX PERSONAL AI** | Personal AI signal system with smart pair and time selection |
| 06–10 | 🔒 | Coming soon |

Open them from **FREE BOTS** in the main menu. They need no separate signup.

---

## 21. Auto Payment System

Subscribe to any plan **instantly and automatically**, directly inside the bot — no need to contact the owner manually.

### Supported Payment Methods

| Method | Details |
|---|---|
| **Binance Pay** | Binance Pay ID: **1133439955** — instant transfer via Binance app |
| **TRC20 USDT** | USDT on the TRON network — wallet address provided in-bot |
| **BEP20 USDT** | USDT on the BNB Smart Chain — wallet address provided in-bot |

### How It Works
1. Tap **🪄 Upgrade** inside the bot
2. Select your plan (STARTER, PLUS, or INFINITY)
3. Choose your payment method (Binance Pay, TRC20, or BEP20)
4. Send the exact USDT amount to the provided address/ID
5. Bot automatically verifies the payment via API
6. Subscription is activated instantly — no manual approval needed

### Payment Rules
- **60-minute expiry window** — payment must be completed within 60 minutes of initiating the request
- **Amount tolerance** — minor blockchain/fee differences handled automatically
- **Auto-verification** — Binance Pay verified via Binance API; on-chain USDT verified via TronGrid (TRC20) and BSC RPC (BEP20)
- You can always contact [@X_Akash_Owner](https://t.me/X_Akash_Owner) for manual activation if preferred

---

## 22. Subscription & Access System

### Subscription Tiers
| Tier | Price | Access Level |
|---|---|---|
| 🆓 FREE | $0 | Limited daily usage |
| 🟢 STARTER | $18/month | Higher usage limits, Live Session & Schedule |
| 💎 PLUS | $32/month | 10× usage, full template customization, Web Control |
| 👑 INFINITY | $49/month | Unlimited usage, + 1 Q-BOT STUDIO bot (INFINITY Studio) |

Subscriptions can be activated for any duration (custom days or permanent) at any tier — the tier determines *what* you can access, the duration determines *how long*.

### Purchase Options
- **Auto Payment** — instant self-serve activation via Binance Pay, TRC20 USDT, or BEP20 USDT
- **Manual** — contact [@X_Akash_Owner](https://t.me/X_Akash_Owner) directly

### Granular Permissions
Per-user feature permissions and daily-usage limits are enforced automatically based on subscription tier.

### Promo Codes
- Admin-issued or earned via referral program
- Discounts or free trial access

Subscriptions are tied to your Telegram user ID — non-transferable.

---

## 23. Points & Quota System

### Points (Free Trial Access)
- Admin grants bonus points to users
- Each Future Signal or Signal Check use can cost 1 point for free-trial access
- Subscribed users use their tier's daily quota instead
- Admin can set "unlimited points" per user

### Daily Signal Quotas (Tier-Based)
- Every tier (FREE, STARTER, PLUS, INFINITY) has its own daily Future Signal and Live Signal allowance
- Quota only counts signals actually delivered to you — quiet scan cycles that find nothing don't use your quota
- Quota remaining is shown live in your profile and in Web Control
- INFINITY subscribers have unlimited daily signals

### Future Live Session Quota
- Free users get a limited number of Future Live sessions
- Subscribed users have unlimited sessions

---

## 24. Scheduled Sessions & Partial Reports

### Scheduled Sessions
- Save a Live Session setup and launch it automatically on chosen **days of the week** at a set start time (optional stop time)
- A pre-alert is sent before each scheduled start

### Partial Reports
Automatic performance summaries during a session, **every 30, 60 or 120 minutes** (or disabled), and on demand with **Send Partial**.

```
📊 PARTIAL REPORT — 15:30
━━━━━━━━━━━━━━━━━━━━━━
Signals Sent : 6
✅ WIN        : 4
❌ LOSS       : 1
🔄 MTG WIN    : 1
━━━━━━━━━━━━━━━━━━━━━━
Win Rate     : 83.3%
```

---

## 25. Referral Program, Reviews & History

- **Referral**: a unique referral link, milestone tracking and promo-code rewards
- **Reviews**: 1–5 star ratings with a public average
- **History**: the signal history of your current session
- **Favourite pairs**: save and reuse personal pair lists

---

## 26. Performance & 24/7 Stability

v5.0 was engineered to be **super fast** and to run **non-stop for weeks**.

| Area | What changed |
|---|---|
| **Analysis speed** | The market analysis engine runs about **14× faster**, and candle-file reading about **6× faster** |
| **Instant buttons** | Button taps are acknowledged immediately, more taps are handled in parallel, and heavy screens are cached |
| **Web apps** | Web Control, HUB, Live Chart and admin pages run on separate worker loops, so one slow request can't freeze the others |
| **Efficient data** | Shared caches for candles, payouts and settings, with reused Telegram and database connections |
| **Self-healing** | Stuck market scans, stalled result checks and frozen web loops are detected and recovered automatically |
| **24/7 launcher** | A supervisor restarts the bot automatically if it ever stops or freezes and logs the reason |
| **Long-run safety** | Memory caches are bounded and old data is cleaned up automatically, so the bot stays fast after weeks of uptime |

---

## 27. Admin Control Panel

Available to the bot owner and delegated sub-admins through Telegram commands and a browser-based **Admin Web Panel** (users, plans, pairs, brokers, signal controls, Strategy Intelligence dashboard, Studio administration and more).

> Details of admin controls are not publicly disclosed.

---

## 28. Database — PostgreSQL Backend

QUANTEX-BOT uses **PostgreSQL** for all persistent storage.

All data is managed through a dedicated `db_postgres.py` module with connection pooling for efficient concurrent multi-user access.

### Data Managed
- User accounts, subscription data, permissions
- Signal history and market statistics
- Session configurations and schedules
- Referral tracking and promo codes
- Review and rating data
- Points, quotas, and limits
- Admin settings and ban lists
- Future Live session data
- Broadcast logs
- Favorite pair lists
- News signal analysis cache (per-event, expires at release time)
- Q-BOT STUDIO data — bots, features, labels, texts, users, licenses, quotas
- Strategy Intelligence history and Scanning Mode signal statistics
- QUANTEX HUB posts, comments, messages and news
- Session log entries (per active session, in-memory)

---

## 📞 Support

- **Telegram**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- **Email**: [quantexbotsupport@gmail.com](mailto:quantexbotsupport@gmail.com)
- **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro) — all updates are posted here first
- **Channel**: [@Quantexbot1](https://t.me/Quantexbot1)
- **Community Group**: [t.me/quantexlounge](https://t.me/quantexlounge)
- **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)
