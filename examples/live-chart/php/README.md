# Live candle chart on your website — PHP

A page with a moving candle chart (M1 to H4) and a pair list, fed by candles and live ticks. A small server file adds your key, so visitors never see it, and shares one answer between all visitors.

Endpoint groups: Brokers & pairs, Candles (OHLC), Live ticks. Result: A live chart that moves with every tick, like the broker’s. Choose the pair and the timeframe at the top.

**How to run:** Copy index.html and api.php into a folder of your website (XAMPP: C:\xampp\htdocs\chart). Open api.php and write your key in the line with qx_live_PUT_YOUR_KEY_HERE. Then open http://localhost/chart/index.html (or your domain).

Files: [`index.html`](index.html), [`api.php`](api.php)

Full documentation: [api/README.md](../../../api/README.md)
