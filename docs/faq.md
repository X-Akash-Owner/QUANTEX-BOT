<sub>[🏠 Home](../README.md) · [📚 Docs](README.md) · [📘 User Guide](user-guide.md) · [🤖 Auto Trading](guide/14-auto-trading.md) · [🧩 Studio](studio.md) · [🔌 API](../api/README.md) · [💰 Pricing](pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

# ❓ QUANTEX-BOT — Frequently Asked Questions (FAQ)

> **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot) | **Support**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)  
> 📘 Looking for step-by-step instructions? Read the [User Guide](user-guide.md).

---

## 📌 General

### What is QUANTEX-BOT?
QUANTEX-BOT is an automated binary options trading signal system on Telegram. It uses a proprietary multi-factor analysis engine combined with AI confirmation to deliver high-confidence BUY/CALL or SELL/PUT signals with real-time charts, payout data, and automatic result tracking.


### Do I need to join a channel?
Yes. You must be a member of our **main channel** [t.me/bdtraderpro](https://t.me/bdtraderpro) to use the bot. All updates, new features and announcements are posted there first. If you leave it, the bot asks you to rejoin and tap **Verify Membership**.

### What's new?
- **3 fully supported brokers**: QUOTEX, TRADOWIX and BINOLLA (300+ markets), plus a **Primary Broker** setting
- **Super-fast and stable**: the analysis engine is about 14× faster, buttons respond instantly, and the bot runs 24/7 with self-healing and automatic restart
- **Q-BOT STUDIO** *(released 18 Oct 2026)*: build your own branded bot in 9 steps, with no coding — FREE / LITE / PRO / ELITE packages
- **Auto Trading** *(v5.3–v5.4)*: the bot trades the signals on your own broker account, with Signal Config, QX Auto TF and money-management plans
- **Seven analyzers** in Strategy Mode, including HYBRID ENGINE V3 and WT POWER
- **Scanning Mode**: a new shared supply/demand zone and trendline engine, with accurate level drawing
- **QUANTEX HUB** community, **Live Chart**, **AXTIRON FS**, **AI Filter** and **Group Live Signal** (for bot owners)

### What broker should I use?
Any of the three: **QUOTEX**, **TRADOWIX** or **BINOLLA**. All are fully supported with OTC and Live markets. Pick your broker in each feature, or set it once in **Settings → Primary Broker**. The full market list is in [SUPPORTED_MARKETS.md](supported-markets.md).

---

## 📡 Signals & Accuracy

### How accurate are signals?
It depends on the market, the timeframe and the analyzer, so no win rate can be promised. In choppy markets the bots send fewer signals to protect quality. Use the checkers and your history to see real results, and test on a demo account first.

### How often does the bot send signals?
At the start of each candle of the timeframe you choose (M1–M15). A signal is sent only when a setup passes every filter, so frequency depends on market conditions. In Scanning Mode, signals are shared the moment a confirmed zone or trendline setup appears.

### What is a DOJI result?
A DOJI candle means the open and close price are equal (no movement). QUANTEX-BOT detects these and reports them separately — they are not counted as WIN or LOSS in your win-rate.

---

## 🤖 AI Signal Confirmation

### What does AI confirmation add?
In Live Signal mode, every signal is additionally validated by an AI model that checks market conditions, calculates support/resistance levels, fetches real-time payout data, and provides a written reason. This is an extra quality layer on top of the base signal engine.

### Can the AI reject a signal?
Yes. If the AI determines the setup is not strong enough, it overrides and blocks the signal from being sent.

### What is "Support & Resistance" in the signal?
Key price levels automatically calculated and included in every Live Signal. Support = price floor. Resistance = price ceiling. They give context for the trade entry.

---

## ⏱ Future Live Signal System

### What is Future Live?
You paste a pre-planned signal list and QUANTEX-BOT automatically sends each signal to your channel at the exact scheduled time, waits for the candle to close, checks the result, and sends WIN/LOSS — all fully automated.

### What signal formats does Future Live accept?
Any format — the universal parser handles everything:
```
▢ 05:50 USDIDR ⇨OTC ☞ PUT
M1 EURUSD_OTC 06:00 BUY
USDCAD-OTC 05:53 PUT
```

### How many Future Live sessions do free users get?
**3 sessions total** (lifetime) for free users. Subscribed users have unlimited sessions.

---

## 🔍 Signal Checker

### What is the Checker Suite?
QUANTEX-BOT includes these checker modes:
- **Live Checker** *(New)* — WIN/LOSS check for real/live market signals
- **OTC Checker** — standard WIN/LOSS check for OTC signals
- **Blackout Checker** — direction-free signals checked using reverse previous-candle logic
- **Whiteout Checker** — direction-free signals checked using follow previous-candle logic
- **Custom Date Checker** — check signals for any specific past date

### What is the Live Checker?
The Live Checker works exactly like the OTC Checker, but for **real (live) market pairs** instead of OTC pairs. Paste your live market signals and receive instant WIN/LOSS/DOJI results.

### What makes the checker "super-fast & 100% accurate"?
The checker uses a **local candle cache** with a pre-built time index for O(1) lookups — no external API calls needed. Candle data is compared directly (open vs close), not estimated. Results are exact.

### What is the Blackout Checker?
For signals that have no direction. The checker looks at the **previous candle** — if it was GREEN, expected direction is PUT; if RED, expected direction is BUY. Then it checks the entry candle against that expected direction.

### What is the Whiteout Checker?
Same as Blackout but logic is reversed — previous GREEN → expected BUY; previous RED → expected PUT.

### What is the Payout Filter?
Set a minimum payout threshold (e.g., 80%). Signals below that threshold are flagged with their actual payout % so you can decide whether to skip them.

### What is the Custom Date Checker?
Check signals for any past date — not just today or yesterday. Bot fetches archived candle data for the chosen date.

---

## 📰 News Signal System

### What is the News Signal?
The News Signal system generates trading signals based on the **Forex Factory economic calendar**. It fetches upcoming economic events (e.g. NFP, CPI, interest rate decisions), analyzes the expected impact using Gemini AI, and produces CALL/PUT recommendations for each of your selected pairs.

### How does it determine direction?
In three layers:
1. **Heuristic** — compares `forecast vs previous` for the event, with inversion logic for negative metrics (e.g. unemployment rate)
2. **AI Analysis** — Gemini AI provides BULLISH/BEARISH/NEUTRAL bias with a confidence score and rationale
3. **Technical Blend** — a 30-day technical structure read (trend + momentum) is blended with the fundamental bias to adjust confidence up or down

### Which pairs are supported by News Signal?
29 pairs: all major forex pairs (EUR, GBP, USD, JPY, CHF, CAD, AUD, NZD combinations) plus XAU/USD.

### Can I filter by news impact level?
Yes — you can filter events by **HIGH**, **MEDIUM**, **LOW**, or show **All** impacts.

### How many days ahead can I see?
1, 2, or 3 days ahead from the current time.

### Is the AI re-run for every user requesting the same event?
No — analysis results are **cached per event** (keyed by title + currency + exact release time). The first user requesting an event pays the AI cost; everyone else requesting the same event within its window gets the cached result instantly. Cache expires after the event's release time.

---

## 🛠️ Signal Tools

### What are the Signal Tools?
Four utility tools for working with signal lists, accessible from the main menu:

- **Signal Formatter** — paste any signal list, receive it reformatted into a clean, standardized card layout
- **Swap C/P** — *coming soon*: will flip every CALL to PUT and vice versa
- **TZ Converter** — paste signals, enter source and target timezone → receive time-converted signals
- **Market Filters** — shows which live markets are currently stable and tradeable

### Who can use the Signal Tools?
All users — the tools are available to FREE, STARTER, PLUS, and INFINITY subscribers.

---

## 💳 Auto Payment

### What is the Auto Payment system?
A self-serve subscription system that lets you activate your plan **instantly inside the bot**, without contacting the owner. Supported methods: **Binance Pay**, **TRC20 USDT**, and **BEP20 USDT**.

### How does it work?
1. Tap **Upgrade** inside the bot
2. Select your plan (STARTER, PLUS, or INFINITY)
3. Choose a payment method
4. Send the exact USDT amount to the provided address/ID
5. Bot verifies payment automatically and activates your subscription immediately

### How long do I have to complete payment?
**60 minutes** from the time you initiate the request. After that, the request expires and you can start a new one.

### Is manual payment still available?
Yes — you can always contact [@X_Akash_Owner](https://t.me/X_Akash_Owner) directly if you prefer manual activation.

---

## 🧠 Analysis Engine

### Which analyzers are there?
Strategy Mode offers **seven analyzers**; the admin decides which are available. See [Strategies](guide/05-strategies.md) for how each one decides.

| Analyzer | Description |
|---|---|
| **QUANTUM SCAN** | Dynamic MTF + structure + practical signals (continuation only) |
| **SMART FOCUS** | Best-quality market analyzer, defended levels and tick pressure |
| **HYBRID ENGINE** | MTF + structure + trap detection, continuation and confirmed reversals |
| **HYBRID ENGINE V2 ASTRA** | RSI strategy and RSI level flow, tuned per market |
| **QUANTEX TURBO** | MACD cross + EMA 50 trend, M1 pullbacks |
| **HYBRID ENGINE V3** | Picks the best of 96 strategy candidates per market automatically |
| **WT POWER** | EMA 7 / 21 + support / resistance zones |

### What are the 20+ analysis modules?
Each signal passes through independent modules including: Trend Continuation, Break of Structure, Change of Character, Engulfing Reversal, MACD Cross, RSI Divergence, Bollinger Breakout, Pin Bar, MTF Confluence, VWAP Reversion, Ichimoku Confluence, Fibonacci Pullback, Candlestick Patterns (Harami, Morning/Evening Star, Tweezer, Three Black Crows), Supertrend + PSAR, CCI Extreme Reversal, and Multi-Indicator Confluence. Only signals where multiple independent modules agree are delivered.

### Which analyzer adapts by itself?
**HYBRID ENGINE V3** replays 96 strategy candidates on each market's recent candles, applies the best one and re-optimises when its win rate drops. For Auto Trading, **QX Auto TF** also chooses the best market and timeframe every minute.

### What is the minimum signal confidence threshold?
Each analyzer has its own confidence threshold with **Normal / Standard / Hard** presets set by the admin. A signal must also pass the closed-candle quality filter and the trend gate. Anything below the threshold is discarded silently.

---

## 🤖 Free Bots Mission

### What is the Free Bots Mission?
QUANTEX is releasing **10 premium trading bots completely free** to all users, one by one. Each bot is independent and has its own unique features.

### Which free bots are available now?
- **Bot #1: HUNTER X QUANTEX** — Live signal software with bad market filter
- **Bot #2: DRAGON X QUANTEX** — OTC Signal Pro with entry timer
- **Bot #3: BLACKOUT FUTURE AI** — AI-powered future signal system (80–95% accuracy)
- **Bot #4: FUTURE SIGNAL AI** — AI-confirmed future signals
- **Bot #5: QX PERSONAL AI** — Personal AI signal system
- Bots #6–10: coming soon

### How do I access the free bots?
Inside QUANTEX-BOT → **Free Bots** menu → select any available bot. No separate login or signup required.

---

## 🤖 Q-BOT STUDIO (Build Your Own Bot)

### What is Q-BOT STUDIO?
A no-code builder that lets you create **your own branded Telegram signal bot** powered by the QUANTEX engine. You need no coding, no experience and no server. It was **released on 18 October 2026**. Release notes: [STUDIO.md](studio.md) · Full guide: [guide/13-qbot-studio.md](guide/13-qbot-studio.md)

### How do I create a bot?
**Q-BOT STUDIO → CREATE**, then 9 steps: **Bot token** (from @BotFather) → **Brand name** → **Support account** → **Timezone** → **Welcome template** → **About template** → **Help template** → **Features** → **Force join** (ENABLE / SKIP). The review screen has **DEPLOY**, **Back** and **CANCEL**. DEPLOY shows a ~4-second progress animation, then your bot is live.

### What are the templates?
5 Welcome, 5 About and 5 Help templates (preview → confirm), 3 chart templates, 3 Live Signal and 3 Live Result templates, plus Future / AXTIRON / News template sections. Your brand name is inserted automatically. FREE, INFINITY and LITE stay on TEMPLATE 01 but can preview every template; PRO and ELITE can apply every template.

### What can I customise?
Features, brand, support, timezone, brokers, force join, button names / colours / font / premium emoji, the drag-and-drop button layout, the chart watermark, all templates and **your bot's strategy** (main-bot analyzers, pre-made, styles, custom mix or the 20-indicator builder, depending on the package). Use **MY BOTS → CUSTOMIZE** or the **STUDIO CONTROL** web app.

### Can I manage my bot's users?
Yes. Send `/admin` in your bot to manage users, licences (7 / 30 days / permanent), bans, broadcasts, stats, logs, usage resets and **open** or **licensed** access. There is also the **Admin Web**. Your bot's users and data are completely separate from the main bot.

### How much does Q-BOT STUDIO cost?

| Package | Price | Bots | Brokers | Features |
|---|---|---|---|---|
| 🆓 FREE | $0 (runs 7 days every 30 days, 4h on / 2h off) | 1 | QUOTEX | 2 |
| 👑 INFINITY | Included with Bot Access INFINITY (6h on / 2h off) | 1 | QUOTEX | 9 |
| 🟢 LITE | $30 / month · $300 / year | 1 | QUOTEX | 14 |
| 🔵 PRO | $55 / month · $550 / year | 3 | Any 2 | 19 |
| 👑 ELITE | $80 / month · $800 / year | 5 | All 3 | 22 |

Buy in **Q-BOT STUDIO → SUBSCRIBE** with Binance Pay or USDT (TRC20 / BEP20). It activates automatically. See [PRICING.md](pricing.md#-q-bot-studio-packages).

### Why did my Studio bot stop by itself?
FREE and INFINITY bots take scheduled breaks (FREE 4h on / 2h off during its 7 days; INFINITY 6h on / 2h off) and start again automatically. Paid bots pause only if the package ends. You get a notice either way, plus one reminder 3 days before a paid package ends.

---

## 🏢 Brokers

### Which brokers are supported?
**QUOTEX** (62 OTC + 28 Live), **TRADOWIX** (101 OTC + 15 Live) and **BINOLLA** (104 OTC + 17 Live). All three are fully supported across every feature. Full list: [SUPPORTED_MARKETS.md](supported-markets.md).

### Can I set my broker once?
Yes. Open **Settings → Primary Broker**, pick your broker and turn on **"Use this broker in all features"**.

### Are more brokers coming?
Yes. Pocket Option, Olymp Trade, Binomo and others are planned. Follow the main channel [t.me/bdtraderpro](https://t.me/bdtraderpro) for updates.

## 📡 Strategy Mode vs Scanning Mode

### What is the difference?
**Strategy Mode** uses one of seven analyzers (QUANTUM SCAN, SMART FOCUS, HYBRID ENGINE, ASTRA, TURBO, HYBRID ENGINE V3, WT POWER). **Scanning Mode** is one shared scanner that watches every open market at once and trades confirmed **supply/demand zone** and **trendline** setups. Both are available in Live Session and Live Signal → Auto.

### Are the zones and trendlines drawn correctly?
Yes. Zones that price has already closed through are discarded, each touch is counted once, and trendlines must be clean, with no candle closing through them. The signal chart shows the exact level the signal came from.

## 🌐 QUANTEX HUB & Live Chart

### What is QUANTEX HUB?
The built-in community: posts with images, likes, comments, direct messages, leaderboards, profiles and daily market news with breaking-news alerts.

### What is the Live Chart?
A candlestick chart for every market of all three brokers, M1 → D1, with 30 days of history and live updates, right inside Telegram.

## 🔮 AXTIRON FS & AI Filter

### What is AXTIRON FS?
An advanced future signal generator. Choose OTC or Live, a timeframe (M1–M15) and a duration (1–5 hours).

### What is the AI Filter?
Paste any future signal list (OTC, Live, Blackout or Whiteout). Each entry is scored against 1–7, 7–15 or 15–30 days of history, and the strongest ones are returned as a new list.

---

## 💎 Telegram Premium Mode

### What is Premium Mode?
Connects your own Telegram account so signals are sent with Telegram **Premium animated emojis** for a more visually distinctive format in the checker and signal outputs.

### Do I need Telegram Premium?
Yes, Premium animated emojis are only displayed correctly to users with an active Telegram Premium subscription.

### Is it safe to connect my account?
Yes. Login is handled through a secure browser WebApp (**OTHERS → Login**). The session is encrypted, 2FA is fully supported and login links expire automatically. Check the connection anytime with **TG Status**.

---

## 🔄 MTG (Martingale)

### What MTG levels are available?
- **Non-MTG** — single signal only
- **MTG 1** — one recovery step
- **MTG 2** — two recovery steps

### Is MTG automatic?
In Live Signal mode, the bot sends the MTG analysis/signal. In Future Live mode, MTG fires automatically at the next candle. Whether you place the actual trade is your choice.

---

## 👥 Referral Program

### How does it work?
Go to **Referral** in the bot → get your unique link → share it. Each verified signup earns you referral credit. Reaching milestones generates exclusive promo codes.

---

## 💰 Pricing & Subscriptions

| Plan | Price |
|---|---|
| 🆓 FREE | $0 |
| 🟢 STARTER | $18 / month |
| 💎 PLUS ⭐ Most Popular | $32 / month |
| 👑 INFINITY | $49 / month |

Tap **🪄 Upgrade** inside the bot to subscribe instantly via **Auto Payment** (Binance Pay, TRC20 USDT, BEP20 USDT), or contact [@X_Akash_Owner](https://t.me/X_Akash_Owner) for manual activation.

**Promo codes** available — follow the main channel [t.me/bdtraderpro](https://t.me/bdtraderpro) or earn via referrals.

---

## 🌐 Web Control

### What is Web Control?
A browser-based dashboard that opens directly inside Telegram (as a Mini App). It shows your live profile, plan, and signal credits, and lets PLUS/INFINITY subscribers manage timezone settings and message templates without typing commands.

### Do I need to create a separate account for Web Control?
No — it opens using your existing Telegram session automatically. Nothing extra to set up.

### Can FREE or STARTER users open Web Control?
Yes — you can view your profile and the subscription plans, with a prompt to upgrade for full control access.

---

## 📋 Session Log Viewer

### What is the Session Log Viewer?
A real-time diagnostic log that records every event in your active live signal session — which pairs were scanned, which signals were generated, which were rejected and why. Accessible from the Web Control dashboard and from the Q-BOT STUDIO Child Admin Panel.

### Does closing the log page lose my data?
No — the log keeps running in the background regardless of whether the page is open. Reopening the page shows the full accumulated history.

---

## 🔒 Trust & Safety

### Is QUANTEX-BOT a scam?
No. QUANTEX-BOT has an active **public community group** — [t.me/quantexlounge](https://t.me/quantexlounge) — where users share real results, both wins and losses, openly. A bot with poor performance couldn't survive that kind of open scrutiny for long. The product is actively maintained and transparently run.

### Can I be sure the bot performs well before paying?
We recommend **backtesting** the signals in demo mode first, so you can verify performance yourself before subscribing or trading real funds. Binary options trading carries real risk, and no signal service — including this one — can promise a 100% win rate.

### Is it safe to connect my Telegram account (Premium Mode)?
Yes. The connection is handled through a secure, encrypted login flow. Your credentials are never exposed or shared, and are stored safely for the sole purpose of verifying your account and enabling Telegram Premium emoji formatting.

---

## ⚠️ Risk Disclaimer

Binary options trading carries high risk. QUANTEX-BOT provides signals to assist your decisions — it does not guarantee profits. Only trade with money you can afford to lose.

**Recommended money management:**
- 1–5% of balance per trade maximum
- Set a daily loss limit
- Never chase losses with bigger stakes

---

## 🌐 Website & Developer API

### Is there a website?
Yes: **[quantexbot.pro](https://quantexbot.pro)** (also in [বাংলা](https://quantexbot.pro/bn) and [Português](https://quantexbot.pro/pt)). It has the documentation, pricing, updates, FAQ, a contact form, the live [system status](https://quantexbot.pro/status) and your account dashboard. Signals and trading tools stay in the Telegram bot. Details: [WEBSITE.md](website.md).

### What is the Developer API?
A REST API at `https://api.quantexbot.pro/v1` for your own apps and bots: brokers, pairs, payouts, **OHLC candles**, **historical candles** and **live ticks** (market data). Full documentation: [DEVELOPER_API.md](../api/README.md) or [quantexbot.pro/docs/api](https://quantexbot.pro/docs/api).

### How do I get an API key?
[Create an account](https://quantexbot.pro/register), verify your email, then open **Dashboard → API keys**. The free Developer plan is included; the key is shown only once.

### Which plan do I need for candles, history or live ticks?
Live candles start with **Candle Basic** ($15, 1 broker) and **Candle Data API** ($30, 2 brokers). **Full Market Data API** ($50) adds all 3 brokers, historical candles and live ticks. See [quantexbot.pro/pricing](https://quantexbot.pro/pricing).

### Does the API give signals?
Not at the moment — the API is for market data. QUANTEX signals are delivered in the Telegram bot, on the website and in the app.

### What is Auto Trading?
The bot trades the signals for you on your own QUOTEX, TRADOWIX or BINOLLA account, with your stake, money management, stop loss and take profit. Your password is never stored. Available for **PLUS** and **INFINITY** → [guide](guide/14-auto-trading.md).

### How do I pay for an API plan?
In **Dashboard → Upgrade plan** with Binance Pay, USDT TRC20 or USDT BEP20. Paste the transaction ID; it is verified automatically and the plan starts at once.

### Can AI assistants read the documentation?
Yes, everything is public: [quantexbot.pro/llms.txt](https://quantexbot.pro/llms.txt), [quantexbot.pro/llms-full.txt](https://quantexbot.pro/llms-full.txt) and the [OpenAPI file](https://api.quantexbot.pro/v1/openapi.json). In this repository: [llms.txt](../llms.txt).

---

## 📞 Support

- 💬 **Telegram**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- 📧 **Email**: [quantexbotsupport@gmail.com](mailto:quantexbotsupport@gmail.com)
- 📣 **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro) — all updates are posted here first
- 📢 **Channel**: [@Quantexbot1](https://t.me/Quantexbot1)
- 👥 **Community Group**: [t.me/quantexlounge](https://t.me/quantexlounge)
- 🤖 **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)
- 🌐 **Website**: [quantexbot.pro](https://quantexbot.pro) · ✉️ [Contact form](https://quantexbot.pro/contact)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
