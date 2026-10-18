# 📘 QUANTEX-BOT — Complete User Guide

> **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot) · **Support**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)

This guide explains **every menu, every step and every button** in QUANTEX-BOT: what each button does, what you see next, and which plan you need. If you read it from top to bottom you will be able to use the whole bot on your own.

---

## 📚 Chapters

| # | Chapter | What it covers |
|---|---|---|
| 1 | [Getting Started & Main Menu](guide/01-main-menu.md) | `/start`, channel join, the full main-menu map, broker selection |
| 2 | [Live Session](guide/02-live-session.md) | The 8-step wizard, every button, running controls, the Session Log |
| 3 | [Schedule Session](guide/03-schedule-session.md) | Automatic sessions on chosen days and times |
| 4 | [Live Signal](guide/04-live-signal.md) | Manual Signal, Auto Signal, Owner Name, Group Live Signal |
| 5 | [Strategies & Strategy Intelligence](guide/05-strategies.md) | Quantum Scan, Smart Focus, Hybrid Engine, Scanning Mode, RECOMMENDED / AVOID |
| 6 | [Future Signals](guide/06-future-signals.md) | OTC / Live / Blackout / Whiteout FS (new and old logic), AXTIRON FS, AI Filter, Future Live |
| 7 | [Signal Checkers](guide/07-checkers.md) | Live, OTC, Blackout and Whiteout checkers, MTG, dates, payout filter |
| 8 | [Tools, News & Payouts](guide/08-tools.md) | News Signal, Formatter, TZ Converter, Market Filters, Live Payouts, Swap C/P |
| 9 | [Live Chart & Indicators](guide/09-live-chart.md) | The chart app, the 4 indicators explained, 87 drawing tools |
| 10 | [Settings](guide/10-settings.md) | Timezones, templates, brokers, what each plan can change |
| 11 | [Account, Payments & Extras](guide/11-account.md) | Profile, Referral, Upgrade & Auto Payment, Reviews, About, Others, Web Control, HUB, Help |
| 12 | [Free Bots](guide/12-free-bots.md) | The 10 free bots: which are open, which are locked |
| 13 | [Q-BOT STUDIO](guide/13-qbot-studio.md) 🟢 *released 18 Oct 2026* | A → Z: packages & pricing, the 9 steps and every button, deploy, My Bots, Customize, Studio Control, strategies, your bot's Admin Panel |

---

## 🗺️ Plan availability at a glance (Bot Access packages)

✅ = available · 🔢 = available with a daily limit · 👁 = view only · — = not available

| Feature | 🆓 FREE | 🟢 STARTER $18 | 💎 PLUS $32 | 👑 INFINITY $49 |
|---|---|---|---|---|
| Live Signal (Manual + Auto) | 🔢 5 / day | 🔢 25 / day | 🔢 60 / day | ✅ Unlimited |
| ▶️ Live Session | — | ✅ ¹ | ✅ ¹ | ✅ ¹ |
| 🗓 Schedule Session | — | ✅ | ✅ | ✅ |
| 💎 Premium Emoji Mode (sessions) | — | ✅ ² | ✅ ² | ✅ ² |
| OTC / Live / Blackout / Whiteout FS | 🔢 2 lists / day | 🔢 3 / day | 🔢 10 / day | ✅ Unlimited |
| AXTIRON FS | 🔢 set by admin ³ | 🔢 3 / day | 🔢 10 / day | ✅ Unlimited |
| AI Filter · News Signal | 🔢 set by admin ³ | ✅ | ✅ | ✅ |
| Future Live | 🔢 3 sessions | ✅ | ✅ | ✅ |
| Future Live custom header / username | — | ✅ | ✅ | ✅ |
| Signal Checkers (all 4) | ✅ | ✅ | ✅ | ✅ |
| Formatter · TZ Converter · Market Filters · Live Payouts | ✅ | ✅ | ✅ | ✅ |
| Live Chart + 2 free indicators + drawings | ✅ | ✅ | ✅ | ✅ |
| Live Chart **QUANTEX EXPERT V1** and **AXTIRON TR V1** | — | — | ✅ | ✅ |
| Settings: timezones, primary broker | ✅ | ✅ | ✅ | ✅ |
| Settings: **edit** templates and titles | 👁 | 👁 | ✅ | ✅ |
| Web Control | 👁 | 👁 | ✅ | ✅ |
| Q-BOT STUDIO ⁴ | FREE Studio bot | FREE Studio bot | FREE Studio bot | 1 INFINITY Studio bot |
| Free Bots · HUB · Referral · Reviews | ✅ | ✅ | ✅ | ✅ |

¹ Live Session signals count toward the same daily allowance as Live Signal (25 / 60 / unlimited).
² Also needs your Telegram account connected via **OTHERS → Login**.
³ The admin decides the FREE allowance for these features (it can also be 0). Your current numbers are always shown in **MY PROFILE**.
⁴ Q-BOT STUDIO has its own packages (released 18 Oct 2026). Every user gets **1 FREE Studio bot**, and **LITE $30 · PRO $55 · ELITE $80** per month add more bots, brokers, features and strategies. INFINITY includes 1 INFINITY Studio bot. See [Studio packages](PRICING.md#-q-bot-studio-packages).

> Limits are defaults and may be changed by the admin. The bot always shows your real remaining allowance. Allowances reset every day at **12:00 AM (midnight)**.

---

## 🔤 Words used in this guide

| Word | Meaning |
|---|---|
| **OTC market** | Broker-generated market that is open 24/7, including weekends (names end in `-OTC`) |
| **Live market** | Real interbank market, open on weekdays only |
| **Timeframe (M1, M5 …)** | Candle length / trade expiry in minutes |
| **CALL / PUT** | UP / DOWN trade |
| **MTG (Martingale)** | A recovery trade on the next candle after a loss. *MTG 1* = one recovery step, *MTG 2* = two |
| **DOJI** | A candle that closes at its open price, reported separately (neither win nor loss) |
| **Payout** | The % profit the broker pays on a winning trade |
| **Partial** | A summary report of results so far (wins, losses, win rate) |
| **Back** | Every screen has a **Back** / **BACK** button that returns to the previous screen without losing what you chose |
| **/cancel** | Type it any time the bot is waiting for text, to stop the current input |

---

## 🆘 Need help?

- Telegram: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- Email: [quantexbotsupport@gmail.com](mailto:quantexbotsupport@gmail.com)
- 📣 **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro). All updates are posted here first, and you must stay joined to use the bot
- Channel: [@Quantexbot1](https://t.me/Quantexbot1) · Community: [t.me/quantexlounge](https://t.me/quantexlounge)

> ⚠️ Binary options trading carries a high level of risk. Signals are analysis, not a guarantee. Trade only with money you can afford to lose.
