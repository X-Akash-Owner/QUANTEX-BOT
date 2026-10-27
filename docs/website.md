<sub>[🏠 Home](../README.md) · [📚 Docs](README.md) · [📘 User Guide](user-guide.md) · [🤖 Auto Trading](guide/14-auto-trading.md) · [🧩 Studio](studio.md) · [🔌 API](../api/README.md) · [💰 Pricing](pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

<div align="center">

# 🌐 QUANTEX Website — quantexbot.pro

**The official QUANTEX website: product information, documentation, user accounts, the Developer API, payments and live system status.**

[![Website](https://img.shields.io/badge/Open-quantexbot.pro-2f6bff?style=for-the-badge)](https://quantexbot.pro)
[![Developer API](https://img.shields.io/badge/Developer-API-8b5cf6?style=for-the-badge)](https://quantexbot.pro/docs/api)
[![Status](https://img.shields.io/badge/System-Status-00b894?style=for-the-badge)](https://quantexbot.pro/status)

</div>

---

## 📌 Contents

- [What the website is for](#-what-the-website-is-for)
- [Addresses](#-addresses)
- [Public pages](#-public-pages)
- [Accounts and security](#-accounts-and-security)
- [User dashboard](#-user-dashboard)
- [Developer API on the website](#-developer-api-on-the-website)
- [Buying an API plan](#-buying-an-api-plan)
- [QUANTEX AI support assistant](#-quantex-ai-support-assistant)
- [System status](#-system-status)
- [Languages](#-languages)
- [For AI assistants and tools](#-for-ai-assistants-and-tools)
- [How the website, the API and the bot fit together](#-how-the-website-the-api-and-the-bot-fit-together)

---

## 🎯 What the website is for

The **Telegram bot** ([@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)) is where traders get signals and use the tools. The **website** is the home of everything around it:

| Area | What you find |
|---|---|
| **Information** | Features, supported brokers and markets, how Live Session / Future Signal / the checkers work, pricing, FAQ, rules, updates |
| **Documentation** | The complete user guide and the Developer API documentation |
| **Account** | Sign up with email or Google, two-step verification, sessions, notifications, profile photo |
| **Developer API** | API keys, usage, request logs, plan limits (market data: candles, history, ticks) |
| **Billing** | Buy and renew Developer API plans with Binance Pay or USDT (TRC20 / BEP20), receipts |
| **Support** | QUANTEX AI assistant (24/7), contact form, Telegram support |
| **Status** | Live health of the website, API, data feeds, Telegram bot and payments |

> **Live Signal** and **Future Signal** also work on the website, without Telegram (daily limits follow your bot package, or the Website Signal package). Everything else stays in the Telegram bot; feature pages have an **Open in Telegram** button.

---

## 🔗 Addresses

| Address | What it is |
|---|---|
| [https://quantexbot.pro](https://quantexbot.pro) | Website (English) |
| [https://quantexbot.pro/bn](https://quantexbot.pro/bn) | Website in বাংলা |
| [https://quantexbot.pro/pt](https://quantexbot.pro/pt) | Website in Português |
| [https://quantexbot.pro/docs/api](https://quantexbot.pro/docs/api) | Developer API documentation |
| [https://api.quantexbot.pro/v1](https://api.quantexbot.pro/v1/status) | Developer API base URL |
| [https://quantexbot.pro/status](https://quantexbot.pro/status) | System status |
| [https://quantexbot.pro/dashboard](https://quantexbot.pro/dashboard) | User dashboard (sign-in required) |

---

## 📄 Public pages

| Page | Path |
|---|---|
| Home | `/` |
| Features · Live Session · Future Signal · Result Checker | `/features`, `/features/live-session`, `/features/future-signal`, `/features/result-checker` |
| The Telegram bot | `/bot` |
| Supported brokers | `/brokers` |
| Live Chart (QUOTEX, TRADOWIX, BINOLLA — tick by tick) | `/live-chart` |
| Pricing (Bot Access packages, Website Signal package, Developer API plans) | `/pricing` |
| Documentation (user guide) | `/docs`, `/docs/<page>` |
| Developer API documentation | `/docs/api` |
| Updates (changelog) | `/updates` |
| FAQ · Rules · Terms · Privacy | `/faq`, `/rules`, `/terms`, `/privacy` |
| Contact | `/contact` |
| System status | `/status` |

All page texts are written in the admin panel (Markdown editor with drafts, preview, publishing and version history), so documentation is always up to date.

---

## 🔐 Accounts and security

- **Sign up** with email and password or with **Google**. The email address is verified before API keys can be created.
- **Two-step verification** (authenticator app) with recovery codes.
- **Sessions** page: see every signed-in device and sign the others out.
- **Password reset** by email; leaked-password check; sign-in rate limits and Cloudflare Turnstile against bots.
- **Notifications** in the dashboard and by email (payments, plan expiry, security events).
- **Telegram link**: connect your Telegram account so payment and plan news also reach you in the bot.
- **Account deletion** on request, with a grace period.
- **Cookie choices**: a consent banner lets you accept, reject or pick categories (necessary, preferences, referral).

---

## 🧭 User dashboard

`/dashboard` — on phones the bottom bar has a **Menu** button that slides a full menu in from the right.

| Section | Pages |
|---|---|
| **Overview** | Plan, bot package, Auto Trading, API activity, quick actions |
| **Signals** | **Live Signal** (with **Auto**: switches to the best market when yours has no good signal) · **Future Signal** · today's history (print, PDF, CSV) |
| **Account** | Profile (photo, name, language, timezone) · Security (password, two-step, sessions) · Notifications · Account settings |
| **API** | API overview · My APIs (which endpoint groups your plan opens) · API keys · API usage · API logs · API documentation |
| **Billing** | Current plan · Upgrade plan · Payment history (with receipts) · Subscription status |

---

## 🔌 Developer API on the website

Full documentation: **[DEVELOPER_API.md](../api/README.md)** (also at [quantexbot.pro/docs/api](https://quantexbot.pro/docs/api)).

| Dashboard page | What you do there |
|---|---|
| **API keys** | Create keys (shown once), choose permissions (scopes), optional IP allow-list and expiry, rotate the secret, revoke |
| **API usage** | Requests per day and per endpoint, monthly quota |
| **API logs** | Every request of the last 90 days (time, endpoint, status, latency, request ID) — request bodies and keys are never stored |
| **My APIs** | Which endpoint groups your plan includes, and from which plan the others are available |

---

## 💳 Buying an API plan

1. **Dashboard → Upgrade plan** → choose Candle Basic, Candle Data API or Full Market Data API (and your broker(s) for the first two).
2. Choose **Binance Pay**, **USDT TRC20** or **USDT BEP20**. The order shows the exact amount (with a small unique fraction), the Pay ID or wallet address and a QR code; it is valid for 60 minutes.
3. Pay, then paste the **transaction ID**.
4. The payment is **verified automatically** against Binance / the blockchain (receiver, currency, exact amount, time, confirmations; a transaction can be used only once). The plan starts at once, limits apply immediately and a receipt is emailed.
5. Reminders are sent 7 days and 1 day before the plan ends; renew or upgrade at any time.

> Bot Access packages (STARTER / PLUS / INFINITY) can be bought in the Telegram bot **or on the website** (connect Telegram once; the bot activates the package and messages you). Q-BOT STUDIO packages are bought only inside the bot. See [PRICING.md](pricing.md).

---

## 🤖 QUANTEX AI support assistant

A chat assistant on every page of the website and dashboard:

- Answers in **English, বাংলা and Português** from the official QUANTEX knowledge base (with links to the right page).
- Inside the dashboard it can read **your own** plan, payments and API usage to answer account questions.
- Keeps your conversation history; **Send to support** hands a conversation to the team.
- Works without any outside AI service (built-in knowledge engine); an AI model can be plugged in by the admin.

---

## 🟢 System status

[quantexbot.pro/status](https://quantexbot.pro/status) is checked **every minute** from the server:

| Component | What is checked |
|---|---|
| Website | quantexbot.pro answers |
| Developer API | api.quantexbot.pro answers |
| Database | accounts, plans and keys |
| Market data engine | brokers, pairs, payouts, candles, checker, news |
| Telegram bot | the bot's live heartbeat |
| Payments | Binance Pay / USDT verification |

The page shows a 90-day uptime bar per component, current incidents with updates, and past incidents. The same data is available as JSON at `GET https://api.quantexbot.pro/v1/status` (no key).

---

## 🌍 Languages

English (at `/`), বাংলা (`/bn`) and Português (`/pt`). The dashboard and emails use the language chosen in your profile. More languages can be added from the admin panel.

---

## 🤖 For AI assistants and tools

The documentation is open to everyone — people, crawlers and AI assistants. No sign-in, no blocking:

| Address | Contents |
|---|---|
| [quantexbot.pro/llms.txt](https://quantexbot.pro/llms.txt) | Short index: what QUANTEX is, every endpoint, links |
| [quantexbot.pro/llms-full.txt](https://quantexbot.pro/llms-full.txt) | The whole API documentation as plain text |
| [quantexbot.pro/docs/api.md](https://quantexbot.pro/docs/api.md) | The same as a Markdown file |
| [api.quantexbot.pro/v1/openapi.json](https://api.quantexbot.pro/v1/openapi.json) | OpenAPI 3.1 description |

In this repository: [llms.txt](../llms.txt), [DEVELOPER_API.md](../api/README.md), [api/openapi.json](../api/openapi.json), [ARCHITECTURE.md](architecture.md).

---

## 🧩 How the website, the API and the bot fit together

See **[ARCHITECTURE.md](architecture.md)** for the full picture. In short:

```
quantexbot.pro (website + dashboard)      api.quantexbot.pro (Developer API)
                 \                            /
                  └──── QUANTEX web platform ┘
                               │  results only (signed, local)
                        QUANTEX Engine Bridge
                               │
          QUANTEX Telegram bot · market data collectors · signal engines
```

The website and the API never run trading analysis themselves: they read the results the QUANTEX engine already produced, so thousands of API users never slow the bot down.

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
