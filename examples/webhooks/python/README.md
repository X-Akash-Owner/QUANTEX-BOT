# Receive signals with webhooks — Python

Instead of asking every few seconds, QUANTEX sends each new signal and its result to your server. This receiver checks the signature, ignores repeats and forwards the signal to Telegram.

Endpoint groups: Webhooks. Result: Every new signal and result is printed (and posted to your Telegram chat when TG_BOT_TOKEN and TG_CHAT are set).

**How to run:** install: `pip install flask requests` · set `QX_WEBHOOK_SECRET` · run: `python webhook.py`

Files: [`webhook.py`](webhook.py)

Full documentation: [api/README.md](../../../api/README.md)
