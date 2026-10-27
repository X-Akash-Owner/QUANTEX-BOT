<sub>[🏠 Home](../README.md) · [📚 Docs](README.md) · [📘 User Guide](user-guide.md) · [🤖 Auto Trading](guide/14-auto-trading.md) · [🧩 Studio](studio.md) · [🔌 API](../api/README.md) · [💰 Pricing](pricing.md) · [📝 Changelog](../CHANGELOG.md)</sub>

# 🏦 QUANTEX-BOT — Supported Brokers & Markets

> **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)  
> Every market listed here works across the whole bot: Live Session, Live Signal (Strategy Mode and Scanning Mode), Checkers, Future Signals, Live Payouts, Market Filters and the Live Chart.

---

## ✅ Three Brokers — Fully Supported

QUANTEX-BOT supports **three brokers**. Each one is a full integration with its own live candle feed, payout data and result checking, not just a list of pair names.

| Broker | OTC Markets | Live Markets | Total | Status |
|---|---|---|---|---|
| 🟦 **QUOTEX** | **62** | **28** | **90** | ✅ Fully supported |
| 🟧 **TRADOWIX** | **101** | **15** | **116** | ✅ Fully supported |
| 🟪 **BINOLLA** | **104** | **17** | **121** | ✅ Fully supported |

### How broker selection works

- **Pick a broker per feature.** When you open Live Session, Live Signal, a Checker, a Future Signal or AXTIRON FS, the bot asks which broker you trade on.
- **Or set a Primary Broker once.** Go to **Settings → Primary Broker**, choose QUOTEX, TRADOWIX or BINOLLA, and turn on **"Use this broker in all features"**. After that the bot uses your broker automatically everywhere and stops asking.
- **Only markets your broker really offers are shown.** Pair lists, payouts and signals always follow the selected broker, so you never get a signal for a market your broker doesn't have.
- **Closed markets are skipped automatically.** Signal engines never analyse a market whose chart is closed. Scanning Mode and the **Avoid under 80%** filter also skip markets paying less than 80%.

> The bot admin can turn any broker on or off. If a broker is temporarily disabled it disappears from the selection until it is enabled again.

---

## 🟦 QUOTEX

**90 markets in total: 62 OTC + 28 Live**

### OTC Markets — 62
_Forex 41 · Crypto 17 · Commodities 4_

**Forex — 41**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDCAD_otc` | `AUDCHF_otc` | `AUDJPY_otc` | `AUDNZD_otc` | `AUDUSD_otc` |
| `BRLUSD_otc` | `CADCHF_otc` | `CADJPY_otc` | `CHFJPY_otc` | `EURAUD_otc` |
| `EURCAD_otc` | `EURCHF_otc` | `EURGBP_otc` | `EURJPY_otc` | `EURNZD_otc` |
| `EURUSD_otc` | `GBPAUD_otc` | `GBPCAD_otc` | `GBPCHF_otc` | `GBPJPY_otc` |
| `GBPNZD_otc` | `GBPUSD_otc` | `NZDCAD_otc` | `NZDCHF_otc` | `NZDJPY_otc` |
| `NZDUSD_otc` | `USDARS_otc` | `USDBDT_otc` | `USDCAD_otc` | `USDCHF_otc` |
| `USDCOP_otc` | `USDDZD_otc` | `USDEGP_otc` | `USDIDR_otc` | `USDINR_otc` |
| `USDJPY_otc` | `USDMXN_otc` | `USDNGN_otc` | `USDPHP_otc` | `USDPKR_otc` |
| `USDZAR_otc` |  |  |  |  |

**Crypto — 17**

|   |   |   |   |   |
|---|---|---|---|---|
| `ATOUSD_otc` | `AVAUSD_otc` | `AXSUSD_otc` | `BCHUSD_otc` | `BNBUSD_otc` |
| `BTCUSD_otc` | `DASUSD_otc` | `DOTUSD_otc` | `ETCUSD_otc` | `ETHUSD_otc` |
| `LINUSD_otc` | `LTCUSD_otc` | `SOLUSD_otc` | `TONUSD_otc` | `TRUUSD_otc` |
| `XRPUSD_otc` | `ZECUSD_otc` |  |  |  |

**Commodities — 4**

|   |   |   |   |   |
|---|---|---|---|---|
| `UKBrent_otc` (UK Brent Oil) | `USCrude_otc` (US Crude Oil) | `XAGUSD_otc` (Silver) | `XAUUSD_otc` (Gold) |  |

### Live Markets — 28
_Forex 20 · Commodities 1 · Indices 7_

**Forex — 20**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDCAD` | `AUDCHF` | `AUDJPY` | `AUDUSD` | `CADJPY` |
| `CHFJPY` | `EURAUD` | `EURCAD` | `EURCHF` | `EURGBP` |
| `EURJPY` | `EURUSD` | `GBPAUD` | `GBPCAD` | `GBPCHF` |
| `GBPJPY` | `GBPUSD` | `USDCAD` | `USDCHF` | `USDJPY` |

**Commodities — 1**

|   |   |   |   |   |
|---|---|---|---|---|
| `XAUUSD` (Gold) |  |  |  |  |

**Indices — 7**

|   |   |   |   |   |
|---|---|---|---|---|
| `AXJAUD` (Australia 200) | `F40EUR` (France 40) | `FTSGBP` (UK 100 (FTSE)) | `HSIHKD` (Hong Kong 50) | `IBXEUR` (Spain 35) |
| `JPXJPY` (Japan 225) | `STXEUR` (Euro Stoxx 50) |  |  |  |

> ✅ **QUOTEX summary:** 62 OTC markets and 28 Live markets are supported, **90 in total**.

---

## 🟧 TRADOWIX

**116 markets in total: 101 OTC + 15 Live**

### OTC Markets — 101
_Forex 43 · Crypto 26 · Commodities 7 · Stocks 25_

**Forex — 43**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDCAD_otc` | `AUDCHF_otc` | `AUDJPY_otc` | `AUDNZD_otc` | `AUDUSD_otc` |
| `CADCHF_otc` | `CADJPY_otc` | `CHFJPY_otc` | `EURAUD_otc` | `EURCAD_otc` |
| `EURCHF_otc` | `EURGBP_otc` | `EURJPY_otc` | `EURNZD_otc` | `EURSGD_otc` |
| `EURUSD_otc` | `GBPAUD_otc` | `GBPCAD_otc` | `GBPCHF_otc` | `GBPJPY_otc` |
| `GBPNZD_otc` | `GBPUSD_otc` | `NZDCAD_otc` | `NZDCHF_otc` | `NZDJPY_otc` |
| `NZDUSD_otc` | `USDARS_otc` | `USDBDT_otc` | `USDBRL_otc` | `USDCAD_otc` |
| `USDCHF_otc` | `USDCOP_otc` | `USDDZD_otc` | `USDEGP_otc` | `USDIDR_otc` |
| `USDINR_otc` | `USDJPY_otc` | `USDMXN_otc` | `USDNGN_otc` | `USDPHP_otc` |
| `USDPKR_otc` | `USDTRY_otc` | `USDZAR_otc` |  |  |

**Crypto — 26**

|   |   |   |   |   |
|---|---|---|---|---|
| `APTUSD_otc` | `ARBUSD_otc` | `ATOMUSD_otc` | `AVAXUSD_otc` | `AXSUSD_otc` |
| `BCHUSD_otc` | `BNBUSD_otc` | `BTCUSD_otc` | `DASHUSD_otc` | `DOGEUSD_otc` |
| `DOTUSD_otc` | `ETCUSD_otc` | `ETHUSD_otc` | `GALAUSD_otc` | `LINKUSD_otc` |
| `LTCUSD_otc` | `MANAUSD_otc` | `MELANIAUSD_otc` | `SOLUSD_otc` | `TIAUSD_otc` |
| `TONUSD_otc` | `TRUMPUSD_otc` | `TRXUSD_otc` | `WIFUSD_otc` | `XRPUSD_otc` |
| `ZECUSD_otc` |  |  |  |  |

**Commodities — 7**

|   |   |   |   |   |
|---|---|---|---|---|
| `BCOUSD_otc` (Brent Oil) | `COPPERUSD_otc` (Copper) | `WTIUSD_otc` (WTI Crude Oil) | `XAGUSD_otc` (Silver) | `XAUUSD_otc` (Gold) |
| `XPDUSD_otc` (Palladium) | `XPTUSD_otc` (Platinum) |  |  |  |

**Stocks — 25**

|   |   |   |   |   |
|---|---|---|---|---|
| `AAPL_otc` | `AMD_otc` | `AMZN_otc` | `ANTH_otc` | `AXP_otc` |
| `BA_otc` | `DIS_otc` | `GOOG_otc` | `GS_otc` | `INTC_otc` |
| `JNJ_otc` | `JPM_otc` | `KO_otc` | `MCD_otc` | `META_otc` |
| `MSFT_otc` | `NFLX_otc` | `NKE_otc` | `NVDA_otc` | `OAIA_otc` |
| `PFE_otc` | `TSLA_otc` | `V_otc` | `WMT_otc` | `XOM_otc` |

### Live Markets — 15
_Forex 13 · Crypto 2_

**Forex — 13**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDJPY` | `AUDUSD` | `EURAUD` | `EURCAD` | `EURCHF` |
| `EURGBP` | `EURJPY` | `EURUSD` | `GBPJPY` | `GBPUSD` |
| `USDCAD` | `USDCHF` | `USDJPY` |  |  |

**Crypto — 2**

|   |   |   |   |   |
|---|---|---|---|---|
| `BTCUSD` | `ETHUSD` |  |  |  |

> ✅ **TRADOWIX summary:** 101 OTC markets and 15 Live markets are supported, **116 in total**.

---

## 🟪 BINOLLA

**121 markets in total: 104 OTC + 17 Live**

### OTC Markets — 104
_Forex 27 · Crypto 9 · Commodities 7 · Indices 11 · Stocks 50_

**Forex — 27**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDCHF_otc` | `AUDJPY_otc` | `AUDUSD_otc` | `EURAUD_otc` | `EURCAD_otc` |
| `EURGBP_otc` | `EURJPY_otc` | `EURUSD_otc` | `GBPAUD_otc` | `GBPCAD_otc` |
| `GBPCHF_otc` | `GBPUSD_otc` | `NZDUSD_otc` | `USDAED_otc` | `USDARS_otc` |
| `USDBDT_otc` | `USDBRL_otc` | `USDCAD_otc` | `USDCHF_otc` | `USDCOP_otc` |
| `USDDZD_otc` | `USDEGP_otc` | `USDIDR_otc` | `USDINR_otc` | `USDMXN_otc` |
| `USDPKR_otc` | `USDSAR_otc` |   |   |   |

**Crypto — 9**

|   |   |   |   |   |
|---|---|---|---|---|
| `BCHUSD_otc` | `BNBUSD_otc` | `BTCUSD_otc` | `DOTUSD_otc` | `ETHUSD_otc` |
| `NEARUSD_otc` | `SOLUSD_otc` | `TONUSD_otc` | `WIFUSD_otc` |   |

**Commodities — 7**

|   |   |   |   |   |
|---|---|---|---|---|
| `XAUUSD_otc` (Gold) | `XAGUSD_otc` (Silver) | `XPTUSD_otc` (Platinum) | `XPDUSD_otc` (Palladium) | `XBRUSD_otc` (Brent Oil) |
| `XTIUSD_otc` (WTI Crude Oil) | `XNGUSD_otc` (Natural Gas) |   |   |   |

**Indices — 11**

|   |   |   |   |   |
|---|---|---|---|---|
| `US100_otc` (Nasdaq 100) | `US500_otc` (S&P 500) | `US2000_otc` (Russell 2000) | `USDX_otc` (US Dollar Index) | `UK100_otc` (FTSE 100) |
| `GER30_otc` (DAX) | `FR40_otc` (CAC 40) | `SPN35_otc` (IBEX 35) | `J225_otc` (Nikkei 225) | `HK33_otc` (Hang Seng) |
| `AUS200_otc` (ASX 200) |   |   |   |   |

**Stocks — 50**

|   |   |   |   |   |
|---|---|---|---|---|
| `AAPL_otc` (Apple) | `ABT_otc` (Abbott) | `AMD_otc` (AMD) | `AMZN_otc` (Amazon) | `BA_otc` (Boeing) |
| `BABA_otc` (Alibaba) | `BAC_otc` (Bank of America) | `BIDU_otc` (Baidu) | `BRK-B_otc` (Berkshire Hathaway) | `BUD_otc` (AB InBev) |
| `C_otc` (Citigroup) | `CAT_otc` (Caterpillar) | `CMCSA_otc` (Comcast) | `CSCO_otc` (Cisco) | `CVX_otc` (Chevron) |
| `DIS_otc` (Disney) | `EBAY_otc` (eBay) | `GOOG_otc` (Alphabet) | `HD_otc` (Home Depot) | `IBM_otc` (IBM) |
| `INTC_otc` (Intel) | `JNJ_otc` (Johnson & Johnson) | `JPM_otc` (JPMorgan) | `KO_otc` (Coca-Cola) | `MA_otc` (Mastercard) |
| `MCD_otc` (McDonald's) | `META_otc` (Meta) | `MMM_otc` (3M) | `MS_otc` (Morgan Stanley) | `MSFT_otc` (Microsoft) |
| `NFLX_otc` (Netflix) | `NKE_otc` (Nike) | `NVDA_otc` (NVIDIA) | `NVS_otc` (Novartis) | `ORCL_otc` (Oracle) |
| `PFE_otc` (Pfizer) | `PG_otc` (Procter & Gamble) | `PM_otc` (Philip Morris) | `SBUX_otc` (Starbucks) | `T_otc` (AT&T) |
| `TSLA_otc` (Tesla) | `V_otc` (Visa) | `VZ_otc` (Verizon) | `WFC_otc` (Wells Fargo) | `WMT_otc` (Walmart) |
| `XOM_otc` (ExxonMobil) | `0700.HK_otc` (Tencent) | `0939.HK_otc` (China Construction Bank) | `BMW.DE_otc` (BMW) | `OR.PA_otc` (L'Oréal) |

### Live Markets — 17
_Forex 17_

**Forex — 17**

|   |   |   |   |   |
|---|---|---|---|---|
| `AUDCAD` | `AUDCHF` | `AUDJPY` | `AUDUSD` | `EURAUD` |
| `EURCAD` | `EURGBP` | `EURJPY` | `EURUSD` | `GBPAUD` |
| `GBPCAD` | `GBPCHF` | `GBPJPY` | `GBPUSD` | `USDCAD` |
| `USDCHF` | `USDJPY` |  |  |  |

> ✅ **BINOLLA summary:** 104 OTC markets and 17 Live markets are supported, **121 in total**. The list is read directly from the BINOLLA data feed, so any market BINOLLA adds later is picked up automatically.

---

## 🕐 OTC vs Live Markets

| | OTC | Live |
|---|---|---|
| **Availability** | 24/7, weekends included | Mon–Fri, during market hours |
| **Price source** | Broker-generated OTC price | Real market price |
| **Best for** | Trading any time | Main trading sessions |
| **Checker** | OTC Checker | Live Checker |
| **Future Signals** | OTC Market FS | Live Market FS |

---

## 📞 Support

- **Telegram**: [@X_Akash_Owner](https://t.me/X_Akash_Owner)
- **Main Channel (required)**: [t.me/bdtraderpro](https://t.me/bdtraderpro) — all updates are posted here first
- **Channel**: [@Quantexbot1](https://t.me/Quantexbot1)
- **Community Group**: [t.me/quantexlounge](https://t.me/quantexlounge)
- **Bot**: [@QuantexBinaryTools_bot](https://t.me/QuantexBinaryTools_bot)

---

<div align="center"><sub>QUANTEX · <a href="https://quantexbot.pro">quantexbot.pro</a> · <a href="https://t.me/QuantexBinaryTools_bot">@QuantexBinaryTools_bot</a> · Trading involves risk — signals are analysis, not a guarantee.</sub></div>
