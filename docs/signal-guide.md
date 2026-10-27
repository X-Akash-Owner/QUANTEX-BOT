<sub>[🏠 Home](../README.md) · [📚 Docs](README.md) · [📘 User Guide](user-guide.md) · [🤖 Auto Trading](guide/14-auto-trading.md) · [🧩 Studio](studio.md) · [🔌 API](../api/README.md) · [💰 Pricing](pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

# 📊 QUANTEX-BOT — Binary Options Signal Guide

> **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)

---

## Reading a Standard Signal

```
📊 QUANTEX BOT SIGNAL
━━━━━━━━━━━━━━━━━━━━
Pair      : EUR/USD OTC
Direction : ⬆️ BUY (CALL)
Entry Time: 14:35
Timeframe : M1
Broker    : Quotex
━━━━━━━━━━━━━━━━━━━━
📈 Session: @username
WIN: 6 | LOSS: 2 | Rate: 75%
```

| Field | Meaning |
|---|---|
| **Pair** | Asset to trade |
| **Direction** | BUY (CALL) = price goes UP; SELL (PUT) = price goes DOWN |
| **Entry Time** | Open trade AT this exact minute |
| **Timeframe** | M1 = 1-minute expiry |
| **Broker** | Which broker the signal is for: QUOTEX, TRADOWIX or BINOLLA |
| **Session Stats** | Running win/loss record |

---

## Reading a Live Signal (AI-Confirmed)

```
📊 LIVE BOT SIGNAL
━━━━━━━━━━━━━━━━━━━━
Pair         : EUR/USD OTC
Direction    : ⬆️ BUY (CALL)
Entry Time   : 14:35
Payout       : 87%
Support      : 1.0821
Resistance   : 1.0847
AI Confidence: HIGH
━━━━━━━━━━━━━━━━━━━━
🤖 Momentum confirmed at support zone.
Entry validated by AI analysis.
```

| Field | Meaning |
|---|---|
| **Payout** | Broker's payout % for this pair right now |
| **Support** | Key price floor level (in Scanning Mode: the exact demand zone or trendline used) |
| **Resistance** | Key price ceiling level (in Scanning Mode: the exact supply zone or trendline used) |
| **AI Confidence** | AI's confidence in the setup (LOW / MEDIUM / HIGH) |
| **AI Reason** | Why the AI confirmed or flagged the signal |

> A higher payout % = higher profit if you win. Signals below your payout threshold are flagged in the Checker.

---

## Reading a News Signal

News Signals are generated from the **Forex Factory economic calendar** and AI direction analysis.

```
📰 NEWS SIGNAL — QUANTEX BOT
━━━━━━━━━━━━━━━━━━━━━━━━━━
Event    : US Non-Farm Payrolls
Currency : 🇺🇸 USD
Impact   : 💥 HIGH
Time     : 08:30:00 AM  (UTC+6: 06:30 PM)
Forecast : 180K  |  Previous: 175K
Direction: ⬆️ BUY-UP-CALL
Confidence: 86%
━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ CALL Pairs:
   EUR/USD · GBP/USD · AUD/USD
🔴 PUT Pairs:
   USD/JPY · USD/CHF · USD/CAD
━━━━━━━━━━━━━━━━━━━━━━━━━━
🤖 Forecast exceeds previous — bullish USD outlook.
Technical structure agrees (bullish, 78% strength).
```

| Field | Meaning |
|---|---|
| **Event** | Economic event name (e.g. NFP, CPI, Interest Rate) |
| **Currency** | The currency whose pairs are affected |
| **Impact** | News impact level: HIGH / MEDIUM / LOW |
| **Time** | Scheduled release time |
| **Forecast / Previous** | Expected value vs last reading |
| **Direction** | AI-determined trade direction (BUY = currency strengthening) |
| **Confidence** | Combined fundamental + technical confidence score (60–95%) |
| **CALL Pairs** | Pairs where you should enter CALL (BUY) |
| **PUT Pairs** | Pairs where you should enter PUT (SELL) |

> **How to use**: Enter the trade **just before** the event release time (the signal shows the entry time as 2 seconds before release). Use M1 expiry on your broker.

---

## Executing a Signal on QUOTEX, TRADOWIX or BINOLLA

1. Open your broker (QUOTEX, TRADOWIX or BINOLLA) and log in
2. Select the **pair** from the signal
3. Set the expiry to the signal's **timeframe** (M1 = 1 minute, M5 = 5 minutes, …)
4. Set your **stake amount**
5. At exactly the **entry time**, click **Higher** (BUY) or **Lower** (SELL)
6. Wait for the candle to close. The bot sends the result automatically.

> ⏰ Enter within the first 5–10 seconds of the signal minute.

---

## Timeframes & Entry Timing

Signals are aligned to the **timeframe you choose**: M1, M2, M3, M5, M10 or M15 in Live Session, and M1, M2, M3 or M5 in Scanning Mode.

```
M1 :  14:31  14:32  14:33  14:34 ...
M5 :  14:30        14:35        14:40 ...
```

A signal always gives the **start time of the entry candle**. If no strong setup is found, the bot simply waits. It never forces a trade.

## Strategy Mode vs Scanning Mode Signals

| | Strategy Mode | Scanning Mode |
|---|---|---|
| **Engine** | QUANTUM SCAN / SMART FOCUS / HYBRID ENGINE | Shared zone & trendline scanner |
| **Setups** | Trend continuation (+ confirmed reversals in Hybrid) | Zone rejection, trendline rejection, break & retest |
| **Extra** | AI confirmation, seven analyzers to choose from | Exact zone/trendline shown on the chart |
---

## WIN / LOSS Results

```
✅ WIN — EUR/USD OTC
Entry : 14:35 BUY
Session: 7W / 2L = 77.8%
```

```
❌ LOSS — EUR/USD OTC
Entry : 14:35 BUY
🔄 MTG Activated — Recovery signal at 14:40...
```

```
🔄 MTG WIN — EUR/USD OTC
Recovery Entry: 14:40 SELL
Result: +profit recovered ✅
```


---

## Payout Data

In Live Signal mode, each signal includes the **real-time broker payout %**.

- Higher payout = higher profit on a WIN
- Low payout signals are flagged in the Signal Checker
- You can set a minimum payout threshold in the Checker settings

---

## OTC vs Live Markets

| | OTC | Live |
|---|---|---|
| Availability | 24/7 (weekends too) | Mon–Fri market hours |
| Market Type | Broker-managed synthetic | Real interbank prices |
| Best For | Anytime trading | Main session trading |
| Checker | OTC Checker | Live Checker |

---

## Signal Tools

### Swap C/P *(coming soon)*
Will flip all directions in a signal list — every CALL becomes PUT, every PUT becomes CALL. The button is in the menu but the tool is not active yet.

### TZ Converter
Have signals in a different timezone? Paste them and select your target timezone — the bot converts all entry times automatically.

### Signal Formatter
Paste any signal list in any format — the Formatter normalizes and outputs a clean, standardized card. Useful for re-sharing or archiving.

### Market Filters
Shows which live market pairs are currently in **stable, tradeable conditions** — helps you avoid choppy pairs before starting a session.

---

## Money Management

**Fixed 2% Stake:**
- Balance: $100 → Normal: $2 | MTG: $4

**Daily Loss Limit:**
- Stop after 3–4 consecutive losses

**Profit Target:**
- Take a break after 15–20% daily profit

---

## Common Mistakes

❌ Late entries (30+ seconds after signal time)  
❌ Overleveraging (10%+ stake per trade)  
❌ Ignoring payout % (low payout = poor risk/reward)  
❌ Emotional revenge trading after losses  
❌ Trading News Signals on extremely low-impact events  

---

## 🤖 Start Using QUANTEX-BOT

- **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)
- **Upgrade / Subscriptions**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro) — all updates are posted here first
- **Channel**: [@Quantexbot1](https://t.me/Quantexbot1)
- **Community Group**: [t.me/quantexlounge](https://t.me/quantexlounge)

*QUANTEX-BOT — AI-Confirmed Signals. Smart Trading.*

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
