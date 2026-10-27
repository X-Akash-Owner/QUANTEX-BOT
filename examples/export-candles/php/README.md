# Download historical candles to CSV — PHP

Downloads every closed candle of a date range for one pair and saves it as CSV, for Excel, backtests or your own database. Long ranges are fetched in parts automatically.

Endpoint groups: Historical candles. Result: A file like EURUSD_otc_M1_2026-09-01_2026-09-30.csv with time, open, high, low, close, payout and volume.

**How to run:** set `QX_API_KEY` · run: `php export.php EURUSD_otc M1 2026-09-01 2026-09-30`

Files: [`export.php`](export.php)

Full documentation: [../../../DEVELOPER_API.md](../../../api/README.md)
