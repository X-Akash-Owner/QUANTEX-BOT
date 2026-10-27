<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 5 · Strategies

[⬅ Back to the User Guide](../user-guide.md)

Live Session, Schedule, Auto Signal and Group Live Signal all ask you to choose an **engine**:

- **STRATEGY MODE**: one of seven analyzers analyses each of your markets: **QUANTUM SCAN**, **SMART FOCUS**, **HYBRID ENGINE**, **HYBRID ENGINE V2 ASTRA**, **QUANTEX TURBO**, **HYBRID ENGINE V3** and **WT POWER** (the admin decides which are offered).
- **SCANNING MODE**: one shared scanner watches every eligible market for supply/demand zones and trendlines.

This chapter explains how each one decides, what kind of signals you get, and how to pick one.

---

## Common rules (all engines)

- Only **closed candles** are used for decisions. The signal is confirmed in a short final window near the end of the current candle, and the trade is for the **next candle** (the admin can switch to "next-next candle" entry).
- **Candle-quality filters** reject untradeable candles: dojis, fully wickless candles, one-sided wicks, abnormally big candles and very small bodies.
- A market that just gave a signal **cools down for 4 minutes**.
- Low-payout markets can be excluded with **AVOID UNDER 80%**.
- Every signal and its result is stored, so your history and results are always based on real outcomes.

---

## ⚛️ QUANTUM SCAN — "DYNAMIC MTF • STRUCTURE • PRACTICAL SIGNALS"

**Style:** trend-following, **continuation only**. Gives the most practical number of signals.

How it decides:

1. **Higher-timeframe trend first.** The trend is checked on the enabled confirmation timeframes (for example M2/M3/M5 for an M1 trade). All of them must agree on **UP** or **DOWN**. If they disagree the market is "SIDEWAYS" and no signal is given.
2. **Trend strength on the trade timeframe:** EMA 9 / EMA 20 / EMA 50 alignment, RSI (14), MACD (12/26/9), ATR and ADX.
3. **Continuation setups only.** Reversals and counter-trend entries are blocked.
4. Needs at least **80 open-market candles** of history.

**Signals you get:** CALL in an up-trend pullback/continuation, PUT in a down-trend continuation. Confidence is shown on the signal (higher = more confirmations).

**Best for:** trending markets, traders who want a steady flow of signals in the direction of the trend.

---

## ✨ SMART FOCUS — "SMART MARKET ANALYZER • BEST QUALITY"

**Style:** quality first. Fewer signals, stricter checks.

How it decides:

1. **Focuses on one market at a time.** It ranks your markets by quality and stays on the best one while it remains good (a quality floor decides when to switch).
2. **Voting system.** Many independent checks vote CALL or PUT:
   - trend-following votes (EMA trend),
   - breakout and price-action votes,
   - candlestick votes (hammer, inverted hammer / shooting star, bullish / bearish engulfing, doji),
   - momentum and oscillator votes,
   - smart-money / market-structure votes.
3. **Protection filters:**
   - **OTC trap / liquidity-sweep detection.** Setups whose trap probability is above the limit (default 58%) are rejected.
   - **False-signal confirmation**, **volatility filter** and **multiple-timeframe timing**.
   - **Left-side level required.** There must be a real support/demand or resistance/supply level behind the entry, and price must show **rejection** from it.
   - **Live tick pressure.** The running ticks must push in the signal direction.
   - **Counter-trend maturity protection** for reversal entries.
4. A signal is sent only if the final score reaches the minimum (default **70**).

**Signals you get:** both continuation and **defended-level reversals** (bounce from support → CALL, rejection from resistance → PUT), only when the level and the tick flow confirm.

**Best for:** traders who prefer fewer but cleaner signals, especially on OTC markets.

---

## 🚀 HYBRID ENGINE — "MTF • STRUCTURE • TRAP • SCORE 75+"

**Style:** a scoring engine that mixes several schools and only fires on a high total score.

How it decides:

1. **Market structure:** higher-highs / higher-lows (up) or lower-highs / lower-lows (down).
2. **Multiple-timeframe alignment** on the enabled confirmation frames.
3. **Setup detection:** continuation setups and reversal setups. Reversals must pass a **support/resistance rejection gate** and a trend-exhaustion check, and continuations must pass a continuation-risk check.
4. **OTC trap scoring**, momentum, EMA trend, RSI, directional candle and volatility checks, plus a live/OTC **market-quality score**.
5. Everything is added into one score. Only setups at or above the threshold are sent (admin default 72, shown to users as **75+**). Markets that are too volatile are skipped.

**Signals you get:** CALL/PUT from either a trend continuation or a confirmed reversal, only with a strong combined score. In Manual Signal, if no setup qualifies you get *"No confirmed Hybrid setup for this candle."*

**Best for:** traders who want strict multi-factor confirmation.

---

## ⚙️ HYBRID ENGINE V2 ASTRA — "RSI STRATEGY • RSI LEVEL FLOW • AUTO"

**Style:** RSI-based rules, tuned **per broker and per market**.

- Every market has its own rule family (RSI levels, RSI flow) and settings. The admin adjusts them from that market's live results.
- **Heikin Ashi confirmation:** the last closed Heikin Ashi candles (3 by default) must all be green for a CALL, or all red for a PUT.
- Closed candles only; works on every broker, market and timeframe.

**Best for:** traders who like clear oscillator rules that are adjusted market by market.

---

## ⚡ QUANTEX TURBO — "MACD CROSS • EMA 50 TREND • CLOSED CANDLES"

**Style:** trend continuation and pullback.

- The **trend** comes from the higher timeframe (EMA 50 and ADX strength).
- The **entry** is a pullback on M1 confirmed by a **MACD cross**, with a reversal-zone filter.
- On Live markets it pauses around **high-impact news**, and after a run of losses it pauses itself.

**Best for:** M1 traders who want trend-following entries only.

---

## 🚀 HYBRID ENGINE V3 — "MORE POWERFUL • MORE ACCURATE"

**Style:** a self-selecting strategy engine.

- It holds **12 strategies × 8 filters = 96 candidates** (EMA 200, RSI range and relative-volume filters).
- For each market and timeframe, every candidate is replayed on the last 120 closed candles and scored on win rate, number of signals and consistency. **The best one is applied automatically.**
- When the applied strategy's win rate falls under **80 %**, the market is re-optimised. While a market is below its floor, it sends no signal.
- The admin can let it **prioritise Live markets**.

**Best for:** traders who want the engine to adapt to each market by itself.

---

## 🚀 WT POWER — "AI DNA WITH 34+ STRATEGY"

**Style:** reversals at support and resistance.

- It combines **EMA 7 / EMA 21** with automatically drawn **support and resistance zones**.
- **SUPPORT_BOUNCE** → CALL and **RESISTANCE_REJECT** → PUT, only when price reaches the zone at the right moment.
- The signal chart shows the zones the signal came from.

**Best for:** traders who trade bounces from clear levels.

---

## 📡 SCANNING MODE — supply/demand zones and trendlines

Scanning Mode is **one shared scanner** that tracks every eligible market live (one engine per broker). Everyone who chose the same timeframe receives **the same signals**. It does **not** publish indicator-only (EMA/RSI/candlestick) signals; every signal comes from a price level.

What it draws and watches:

| Level | How it is built |
|---|---|
| **Demand zone (support)** | Cluster of swing lows where price reacted up. Touches closer than 3 bars are counted once. A zone that a candle **closed through** by more than 0.1 ATR is removed as broken |
| **Supply zone (resistance)** | Same, from swing highs |
| **Trendlines** | Drawn through two swing points at least 5 bars apart, with the **latest swing as the second anchor**. No candle may close through the line between the anchors. Broken lines are flagged and not traded as rejections |

Signal types (shown as the "pattern" in the Session Log):

| Setup | Signal |
|---|---|
| **DEMAND_REJECTION** | Price taps a valid demand zone and rejects up → **CALL** |
| **SUPPLY_REJECTION** | Price taps a valid supply zone and rejects down → **PUT** |
| **LOWER_TRENDLINE_REJECTION** | Bounce from a rising (lower) trendline → **CALL** |
| **UPPER_TRENDLINE_REJECTION** | Rejection from a falling (upper) trendline → **PUT** |
| **SUPPLY_BREAK_CONFIRMED_RETEST** | Supply zone broken, then retested from above → **CALL** |
| **DEMAND_BREAK_CONFIRMED_RETEST** | Demand zone broken, then retested from below → **PUT** |
| **UPPER_TRENDLINE_BREAK_RETEST** | Falling (upper) trendline broken upward, then retested → **CALL** |
| **LOWER_TRENDLINE_BREAK_RETEST** | Rising (lower) trendline broken downward, then retested → **PUT** |

Extra rules:

- A rejection needs an **unbroken** level, and a signal is blocked if an **opposing level** is too close (no CALL straight into resistance).
- **Optional MTF confirmation:** the admin can require agreement on higher frames (M2, M3, M5, M10, M15).
- **Persistence:** the condition must hold for a moment (crypto pairs need 2 hits / 2 s, others 1 hit / 1 s) so a single tick spike does not trigger a signal.
- Timeframes: **M1, M2, M3, M5** only. Markets need payout data and enough history.

**Best for:** traders who trade support/resistance and trendline bounces, and want many markets covered at once.

---

## 🧭 Choosing an analyzer

| You want… | Try |
|---|---|
| A steady flow of signals in the trend's direction | **QUANTUM SCAN** |
| Fewer, cleaner signals, especially on OTC | **SMART FOCUS** |
| Strict multi-factor confirmation | **HYBRID ENGINE** |
| An engine that picks the best strategy per market by itself | **HYBRID ENGINE V3** |
| RSI rules tuned per market | **HYBRID ENGINE V2 ASTRA** |
| M1 trend pullbacks | **QUANTEX TURBO** |
| Bounces from support / resistance | **WT POWER** or **SCANNING MODE** |

What the analyzer buttons show:

| Mark | Meaning |
|---|---|
| **• AVOID** (red button) | The admin marked this analyzer to avoid for a while (1 h, 3 h or 24 h), for example in bad market conditions |
| Hidden analyzer | Switched off by the admin |

Every signal and its result is stored, so your history, the checkers and the result messages are always based on real outcomes.

> 💡 For **Auto Trading**, Signal Config also offers **QX Auto TF**, which chooses the market and the timeframe itself. See [Auto Trading](14-auto-trading.md#144-signal-config--qx-auto-tf).

[⬅ Live Signal](04-live-signal.md) · [Next: Future Signals ➡](06-future-signals.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
