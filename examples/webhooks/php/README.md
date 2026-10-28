# Receive signals with webhooks — PHP

Instead of asking every few seconds, QUANTEX sends each new signal and its result to your server. This receiver checks the signature, ignores repeats and forwards the signal to Telegram.

Endpoint groups: Webhooks. Result: Every new signal and result is printed (and posted to your Telegram chat when TG_BOT_TOKEN and TG_CHAT are set).

**How to run:** Upload webhook.php to your website, open it and write your webhook secret (and, if you like, your bot token and chat). Add its https:// address in Dashboard → API → Webhooks and press Send test.

Files: [`webhook.php`](webhook.php)

Full documentation: [api/README.md](../../../api/README.md)
