# Result checker from a file — Python

Write your signals in signals.txt (one per line, the same format as the bot) and get WIN / LOSS / NO DATA for each one with martingale, the win rate and a results.csv for Excel.

Endpoint groups: Signal checker. Result: A table with the result of each signal, the summary and results.csv in the folder.

**How to run:** install: `pip install requests` · set `QX_API_KEY` · run: `python checker.py`

Files: [`checker.py`](checker.py), [`signals.txt`](signals.txt)

Full documentation: [api/README.md](../../../api/README.md)
