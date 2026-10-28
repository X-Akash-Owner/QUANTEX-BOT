# Live candle chart on your website — Node.js

A page with a moving candle chart (M1 to H4) and a pair list, fed by candles and live ticks. A small server file adds your key, so visitors never see it, and shares one answer between all visitors.

Endpoint groups: Brokers & pairs, Candles (OHLC), Live ticks. Result: A live chart that moves with every tick, like the broker’s. Choose the pair and the timeframe at the top.

**How to run:** set `QX_API_KEY` · run: `node server.js`

Files: [`index.html`](index.html), [`server.js`](server.js)

Full documentation: [api/README.md](../../../api/README.md)
