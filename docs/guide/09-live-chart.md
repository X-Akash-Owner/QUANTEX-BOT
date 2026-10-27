<sub>[🏠 Home](../../README.md) · [📚 Docs](../README.md) · [📘 User Guide](../user-guide.md) · [🤖 Auto Trading](14-auto-trading.md) · [🧩 Studio](../studio.md) · [🔌 API](../../api/README.md) · [💰 Pricing](../pricing.md) · [📝 Changelog](../../CHANGELOG.md)</sub>

# 9 · Live Chart & Indicators

[⬅ Back to the User Guide](../user-guide.md)

**LIVE CHART** opens a full candlestick chart inside Telegram (a Mini App) for any market of QUOTEX, TRADOWIX or BINOLLA, with 4 built-in indicators and 87 drawing tools.

| | |
|---|---|
| **Plan** | Chart, drawings and the 2 FREE indicators: everyone. **QUANTEX EXPERT V1** and **AXTIRON TR V1**: PLUS and INFINITY |
| **Open it** | Main menu → **LIVE CHART** |

---

## 9.1 First screen and layout

1. **SELECT YOUR BROKER**: tap your broker. Later you can switch any time by tapping the broker name at the top (**QUOTEX BROKER ⇄**).
2. The chart loads with the live clock at the top right.

### Top bar

| Element | What it does |
|---|---|
| **Pair button** (flags + name) | Opens **Select Asset** (see 9.2) |
| Price | Current price of the market |
| **☀️ / 🌙** | Switch light / dark theme |
| Signal button | *"AI signal overlay — coming soon"* |
| Dot | Connection status (live data) |

### Toolbar

| Element | What it does |
|---|---|
| **1m 2m 3m 5m 10m 15m 20m 25m 30m** | Quick timeframe switch |
| **▥** | Candlestick chart |
| **📈** | Line chart |

### Bottom navigation

| Tab | What it opens |
|---|---|
| **▤ Watchlist** | Your market list: **Favorites**, **Top payout**, **All**. **＋ Add** to add favourites |
| **⌁ Chart** | Closes any open panel and returns to the chart |
| **◒ Indicators** | The indicator sheet (9.3) |
| **✎ Draw** | The drawing tools (9.4) |
| **☰ Menu** | Chart settings (9.5) |

---

## 9.2 Select Asset

| Control | What it does |
|---|---|
| **🔍 Search** | Type a pair name |
| **All Markets / OTC Only / Live Only** | Market type filter |
| **All · ★ Favorites · Currencies · Exotics · Crypto · Commodities** | Category tabs |
| **★** on a row | Add / remove favourite |
| Tap a row | Opens that market (rows show the payout) |

**Interval** (from the timeframe menu): 1m, 2m, 3m, 5m, 10m, 15m, 20m, 25m, 30m, 35m, 40m, 45m, 1h, 4h, 1D.

---

## 9.3 Indicators

Open **◒ Indicators**. Each card has an **Apply** button (it becomes **Remove** when active). Indicators are recalculated automatically for the selected pair and timeframe whenever a new candle closes.

| Indicator | Badge | Plan |
|---|---|---|
| **QUANTEX EXPERT V1** | ★ Official | PLUS / INFINITY |
| **AXTIRON TR V1** | ★ Official, has **Settings** | PLUS / INFINITY |
| **Momentum Reversal Pulse** | FREE | Everyone |
| **OrderFlow Trend Matrix** | FREE | Everyone |

On STARTER/FREE the official cards show **★ 🔒**. Tapping them shows *"This official indicator requires a minimum Plus package. Upgrade to Plus or Infinity to unlock and apply it to your chart."* with **Got it**.

### Labels used on the chart (all indicators)

| Label | Meaning |
|---|---|
| **BUY NEXT** (green, under the candle) | CALL on the **next** candle |
| **SELL NEXT** (red, above the candle) | PUT on the next candle |
| **✓** | The signal won on the next candle |
| **M✓** / **MTG WIN** | Lost first, won on the 1-step martingale candle |
| **×** | Lost (also after the MTG candle) |

---

### ⭐ QUANTEX EXPERT V1 *(PLUS / INFINITY)*

*"Premium adaptive trading intelligence with high-confidence next-candle signals, smart confirmations and real-time performance insights."*

**How it works: it picks the best strategy for this chart by itself.**

1. Needs at least **210 candles** of history.
2. It back-tests **12 entry strategies × 8 filter combinations = 96 setups** on the **last 120 candles** of the current pair and timeframe:

| # | Entry strategy (BUY / SELL) |
|---|---|
| 1 | Price crosses the **Hull MA 13** up / down |
| 2 | Price crosses **SMA 8** with RSI above / below 50 |
| 3 | **EMA 7 / EMA 21** crossover |
| 4 | EMA 7/21 crossover **in the direction of EMA 200** |
| 5 | Price re-enters the **Bollinger Bands (20, 2)** from the lower band / falls back from the upper band |
| 6 | Close breaks the **10-bar high / low** |
| 7 | **RSI 14** crosses back above 30 / below 70 |
| 8 | EMA 7/21 crossover confirmed by RSI and **relative volume** |
| 9 | **MACD (12/26/9)** crosses its signal line |
| 10 | **Engulfing-style reversal** candle |
| 11 | Close breaks the **5-bar high / low** |
| 12 | Price above / below **VWAP** plus a **fair-value gap or order block** |

   Filters that can be combined with each strategy: **EMA 200 trend filter**, **RSI band filter** (BUY 35–75, SELL 25–65), **volume filter** (relative volume ≥ 0.5).
3. Each setup is scored: **60% win rate + 25% number of signals + 15% consistency** (recent 30 candles vs the whole window). Setups with fewer than 8 signals are skipped when possible. The best one is used.
4. **Live signal:** in the **last 30 seconds** of the running candle, if the chosen setup triggers, the chart shows **BUY NEXT** or **SELL NEXT** for the next candle. Once issued for that candle it does not change.

**What is drawn:** EMA 7 (yellow), EMA 21 (cyan), VWAP (orange, only when the VWAP strategy is chosen), the 20-bar lowest low (green) and highest high (pink) channel, and the signal/result labels of the back-test.

**Expert panel:**

| Field | Meaning |
|---|---|
| **TOTAL SIGNALS** | Signals of the chosen setup in the last 120 candles |
| **WIN SIGNALS / LOSS SIGNALS** | Wins (direct + MTG) and losses |
| **WIN RATE** | Wins ÷ total |
| **LAST SIGNAL** | The live BUY NEXT / SELL NEXT, or the last result |
| **MARKET PRESSURE** | Bull vs bear pressure of the last 20 candles (candle body × volume), shown as a 3–97% slider. Above 50% = buyers stronger |

---

### ⭐ AXTIRON TR V1 *(PLUS / INFINITY)*

*"Non-repainting next-candle signals with Pine-style pivot-strength S/R zones, QQE confirmation and a live market-state panel."*

**1. Support / Resistance zones.** Pivot highs and lows (default **pivot period 14**, from candle **close/open**) over the **loopback** window (default 290 candles) are grouped into channels no wider than **4%** of the recent range. Each channel gets a **strength** = 20 × pivots inside + candle touches. The strongest non-overlapping channels are drawn (up to **10**):

- **red** = resistance (above price), **green** = support (below price), **grey** = price is inside the channel.

**2. QQE signal engine.** A smoothed RSI with QQE trailing bands (RSI length, smoothing, **QQE factor 0.238**, threshold, sensitivity). When the smoothed RSI crosses its band a raw BUY or SELL appears.

**3. Price-action filter** (on by default). A BUY is kept only if the candle is **near a support zone**, has a **long lower rejection wick** (> 0.8 × body) or is a **bullish engulfing**. SELL mirrors this with resistance, upper wick and bearish engulfing.

**4. Non-repainting.** Signals are calculated only on **closed candles** and saved, so a printed BUY NEXT / SELL NEXT never disappears.

**Dashboard panel (top-left or bottom-left):**

| Field | Meaning |
|---|---|
| **SUPPORT RESPECT** | Share of zone touches where price is holding above support |
| **RESISTANCE RESPECT** | Share of zone touches where price is holding below resistance |
| **BREAKOUT RATE** | How often candles closed through a zone |
| **TOTAL TOUCHES** | Touches across all drawn zones |
| **LAST SIGNAL** | BUY NEXT / SELL NEXT |
| **Market state** | **RESPECTING MARKET** (breakout rate ≤ 15%, levels hold, so bounces are better) or **BREAKOUT MARKET** (> 15%, levels break often) |

A badge shows the pair and timeframe.

**AXTIRON Settings** (tap **Settings** on the card → **Save settings** / **Reset**):

| Group | Options |
|---|---|
| **Main** | Main BUY/SELL signals · Price-action filter · 2-Bar BUY/SELL indicator (signals after two same-colour candles) |
| **Support / Resistance** | Pivot period (4–30) · Pivot source (Close/Open or High/Low) · Maximum channel width % (1–8) · Minimum strength (1–20) · Maximum S/R zones (1–10) · Loopback period (100–400) · Touch tolerance % · Show S/R zones · Show pivot points · Show broken S/R |
| **S/R Colours** | Resistance colour · Support colour · Price-in-channel colour |
| **Moving Averages** | MA 1 and MA 2: on/off, length (1–500), type SMA/EMA (defaults 50 and 200) |
| **QQE Signal Engine** | RSI length · RSI smoothing · QQE factor · Threshold · Sensitivity scaler |
| **Dashboard** | Show pair & timeframe badge · Show dashboard panel · Panel position (Top Left / Bottom Left) |

---

### 🆓 Momentum Reversal Pulse *(FREE)*

*"Adaptive momentum shifts with structure-aware confirmation for cleaner reversal timing."*

- Draws an **RSI 14** panel at the bottom with dashed **30** (green) and **70** (red) lines.
- **BUY NEXT** when RSI crosses **back above 32** (leaving oversold), **or** a bullish order-block candle appears (a red candle followed by a green candle closing above its high) while RSI is below 46.
- **SELL NEXT** when RSI crosses **back below 68**, **or** a bearish order-block candle appears while RSI is above 54.
- Uses the last 120 candles, at least 2 candles between signals, and marks each result ✓ / MTG WIN / ×.

### 🆓 OrderFlow Trend Matrix *(FREE)*

*"Responsive trend alignment combined with institutional-zone confirmation."*

- Draws **EMA 7** (teal) and **EMA 21** (gold).
- **BUY NEXT** when EMA 7 crosses **above** EMA 21, **or** a bullish order-block candle closes above EMA 7 while EMA 7 > EMA 21.
- **SELL NEXT** when EMA 7 crosses **below** EMA 21, **or** a bearish order-block candle closes below EMA 7 while EMA 7 < EMA 21.
- Results marked ✓ / MTG WIN / ×.

Both free indicators can be active together (badge **FREE · 2 ACTIVE**), and together with the official ones.

---

## 9.4 Drawing tools (✎ Draw)

Search box plus 6 categories, **87 tools** in total:

| Category | Tools |
|---|---|
| **Trend lines (17)** | Trend Line, Ray, Info Line, Extended Line, Trend Angle, Horizontal Line, Horizontal Ray, Vertical Line, Cross Line, Parallel Channel, Regression Trend, Flat Top/Bottom, Disjoint Channel, Pitchfork, Schiff Pitchfork, Modified Schiff Pitchfork, Inside Pitchfork |
| **Gann & Fibonacci (15)** | Fib Retracement, Trend-Based Fib Extension, Fib Channel, Fib Time Zone, Fib Speed Resistance Fan, Trend-Based Fib Time, Fib Circles, Fib Spiral, Fib Speed Resistance Arcs, Fib Wedge, Pitchfan, Gann Box, Gann Square Fixed, Gann Square, Gann Fan |
| **Patterns (14)** | XABCD, Cypher, Head and Shoulders, ABCD, Triangle Pattern, Three Drives, Elliott Impulse (12345), Elliott Correction (ABC), Elliott Triangle (ABCDE), Elliott Double Combo (WXY), Elliott Triple Combo (WXYXZ), Cyclic Lines, Time Cycles, Sine Line |
| **Forecasting & measurement (12)** | Long Position, Short Position, Forecast, Bars Pattern, Ghost Feed, Projection, Anchored VWAP, Fixed Range Volume Profile, Anchored Volume Profile, Price Range, Date Range, Date and Price Range |
| **Geometric shapes (16)** | Brush, Highlighter, Arrow, Arrow Marker, Arrow Marker Up/Down, Rectangle, Rotated Rectangle, Path, Circle, Ellipse, Polyline, Triangle, Arc, Curve, Double Curve |
| **Annotation (13)** | Text, Note, Price Note, Pin, Table, Callout, Comment, Price Label, Signpost, Flag Mark, Image, Tweet, Idea |

Plus **Cursor** (stop drawing) and **Clear All**.

**Editing a drawing:** tap it to open the editor bar: colour picker, **T** (text), width **1–4 px**, line style (solid ━, dashed ┄, dotted ┈), opacity **100/75/50/25%**, **⧉** clone, **🔓/🔒** lock, **◉** hide, **⌫** delete, **✓** done.

---

## 9.5 Chart settings (☰ Menu)

| Setting | Options |
|---|---|
| **Chart type** | Candles / Line |
| **Appearance** | Dark / Light |
| **Time zone** | Display timezone of the chart |
| **Up candle / Down candle** | Candle colours |
| **Chart background** | Background colour |

Favourites, indicator choices and settings are remembered on your device.

[⬅ Tools](08-tools.md) · [Next: Settings ➡](10-settings.md)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
