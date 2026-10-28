# Changelog

All notable QUANTEX releases, newest first. Dates are in 2026 (UTC+6).

[🏠 Home](README.md) · [📚 Docs](docs/README.md) · [🗺️ Roadmap](docs/roadmap.md)

---

## v5.4 — 28 October

### 🤖 Auto Trading
- **Signal Config**: turn it on and the bot runs Auto Signal for you while auto trading runs. You choose the strategy, timeframe (M1–M15), market and entry. It uses your normal Live Signal allowance.
- **QX Auto TF**: a new strategy only for auto trading. Every minute it checks the best-paying open markets on M1, M2, M3, M4 and M5 and trades the strongest market on its best timeframe, one trade at a time.
- **Money-management plans** (one at a time):
  - **Normal plan**: $100 in 5 cycles of $20, each cycle about +$5, with no martingale.
  - **Masaniello sheet**: capital, trades, expected wins and odds give an exact stake table.
  - **Smart Money Management**: the sheet without martingale, with safety only.
- **Account safety**: about half of the orders wait for a better price than the candle open, so your trading looks less automated.
- **Skip after a loss**: after a lost signal, the bot only watches the next signals until one would have won.
- **Finish card**: when a plan, stop loss or take profit ends the run, a card shows your start balance, profit and current balance. The same summary comes as a Telegram message.
- Broker **order ID** in the log and the history. The dashboard keeps counting until you sign out or reset it.
- **Fixed**: QUOTEX M5 wins were sometimes reported as losses.
- **Fixed**: one run could start twice.
- **Fixed**: the QUOTEX connection order (quotex.com first) and long-run connection stability.

### 📡 Signals
- **M4** timeframe is supported by the analysis engine (used by QX Auto TF).
- The **Strategy Intelligence** layer was retired to keep the bot fast; you choose the analyzer yourself.

### 🧩 Q-BOT STUDIO
- **AXTIRON FS** can be added to PRO and ELITE bots (PRO 20 features, ELITE 23).
- New subscription screens: a short overview, then package details point by point, a MONTHLY / YEARLY switch and BUY.

### 🌐 Website
- Telegram bot packages (**STARTER / PLUS / INFINITY**) can be bought on the website again. The bot activates them and sends you a message.
- **Website Signal package** ($25 / 30 days): unlimited Live and Future signals on the website and app.
- **Live Signal → Auto**: if your market has no good signal, it switches to the best market of the minute.
- **Live Chart**: BINOLLA added, moving tick by tick like QUOTEX and TRADOWIX.
- Cookie consent banner (necessary, preferences, referral).

### 🔌 Developer API
- **BINOLLA live ticks** on `GET /v1/ticks` and `GET /v1/stream/ticks`.
- The **Signal API** is back next to the Market Data API: live signals and results, future signal lists, the signal checker, economic news, webhooks and the signal stream.
- **Starter**, **Pro** and **Business** plans are on sale again; the **Developer** plan stays free.
- New code examples: Telegram signal bot, result checker and webhook receiver (Python, Node.js, PHP).
- Pair names with a dot (BINOLLA stocks such as `0700.HK_otc`, `BMW.DE_otc`) are accepted everywhere.

---

## v5.3 — 22 October

- **Auto Trading** released. The bot trades the signals on your own QUOTEX, TRADOWIX or BINOLLA account:
  - an encrypted session (the password is never stored);
  - martingale and recovery;
  - stop loss and take profit auto stop;
  - safety margin, payout filter and max trades at once;
  - log and history.
- **HYBRID ENGINE V3** analyzer.
- The Developer API now focuses on market data: candles, history and ticks. The signal endpoints are paused.

## v5.2 — 18 October

- **Q-BOT STUDIO** public release:
  - FREE / LITE / PRO / ELITE packages;
  - a 9-step wizard with an animated deploy;
  - per-bot strategies;
  - chart, signal and result templates;
  - drag-and-drop buttons;
  - the STUDIO CONTROL web app.

## v5.1

- Website [quantexbot.pro](https://quantexbot.pro) in 3 languages, with accounts, dashboard and AI support.
- Developer API, automatic USDT / Binance Pay billing and a public status page.

## v5.0

- 3 brokers (BINOLLA added) and Primary Broker.
- Q-BOT STUDIO with templates.
- Scanning Mode with accurate zones and trendlines.
- About 14× faster engine and a 24/7 self-healing runtime.
- QUANTEX HUB, Live Chart, AXTIRON FS, AI Filter and Group Live Signal.

## v4.0

- TRADOWIX broker.
- Auto Payment (Binance Pay, TRC20, BEP20).
- News Signal System.
- Live Checker.
- Signal Tools.
- Live / Blackout / Whiteout FS.
- Bot Builder expansion.

## v3.x and earlier

- **v3.x**: tiered subscriptions, Web Control and the Admin Web Panel.
- **v3.0**: AI confirmation, live broadcast and the checker suite.
- **v2.0**: the full bot manager.
- **v1.x**: the core signal engine.

Full detail: [Roadmap → Version history](docs/roadmap.md#-version-history).
