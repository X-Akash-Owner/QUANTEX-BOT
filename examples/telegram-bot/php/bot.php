<?php
/*
 * QUANTEX API - complete Telegram bot (PHP 8.0+, curl extension)
 *
 * Commands
 *   /pairs                       best paying open OTC pairs
 *   /price EURUSD_otc            newest live tick of a pair
 *   /candles EURUSD_otc M5 10    the last candles of a pair
 *   /check  (+ your list)        WIN / LOSS of a signal list (result checker)
 *   /results                     today's results of the QUANTEX live signals
 *   /news                        today's high impact news with direction
 *   /future 18:00 22:00          a future signal list
 *   /live on | /live off         post every QUANTEX live signal and its result here
 *
 * Run (from a terminal, it keeps running)
 *   export QX_API_KEY="qx_live_..."        (Windows: set QX_API_KEY=qx_live_...)
 *   export TG_BOT_TOKEN="123456:ABC..."    (from @BotFather)
 *   php bot.php
 */

$QX_API = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$QX_KEY = getenv('QX_API_KEY') ?: exit("Set QX_API_KEY first.\n");
$TG_API = (getenv('TG_API') ?: 'https://api.telegram.org').'/bot'.(getenv('TG_BOT_TOKEN') ?: exit("Set TG_BOT_TOKEN first.\n"));
$BROKER = getenv('QX_BROKER') ?: 'quotex';          // quotex, tradowix or binolla
$TZ = (float) (getenv('QX_TZ') ?: 6);              // your UTC offset, e.g. 6 for Bangladesh
const SUBSCRIBERS_FILE = __DIR__.'/subscribers.json';

class QuantexError extends Exception {}

// ---------------------------------------------------------------- QUANTEX API
/** Call the QUANTEX API and return `data`, or throw QuantexError. */
function qx(string $method, string $path, array $params = [], ?array $body = null): array
{
    global $QX_API, $QX_KEY;
    $url = $QX_API.$path.($params ? '?'.http_build_query($params) : '');
    for ($attempt = 0; $attempt < 3; $attempt++) {
        $ch = curl_init($url);
        $retryAfter = 5;
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$QX_KEY, 'Content-Type: application/json'],
            CURLOPT_POSTFIELDS => $body !== null ? json_encode($body) : null,
            CURLOPT_HEADERFUNCTION => function ($ch, $line) use (&$retryAfter) {
                if (stripos($line, 'Retry-After:') === 0) { $retryAfter = (int) trim(substr($line, 12)); }
                return strlen($line);
            },
        ]);
        $raw = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);
        if ($raw === false) {
            throw new RuntimeException('QUANTEX API not reachable');
        }
        if ($status === 429 && $attempt < 2) {            // rate limit: wait as told, then retry
            sleep(max(1, $retryAfter));
            continue;
        }
        $answer = json_decode($raw, true);
        if (! empty($answer['ok'])) {
            return $answer['data'];
        }
        throw new QuantexError($answer['error']['code'].': '.$answer['error']['message']);
    }
    throw new QuantexError('rate_limited: too many requests');
}

// ---------------------------------------------------------------- Telegram
function tg(string $method, array $params = [])
{
    global $TG_API;
    $ch = curl_init("$TG_API/$method");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 40,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($params),
    ]);
    $raw = curl_exec($ch);
    curl_close($ch);

    return $raw === false ? null : (json_decode($raw, true)['result'] ?? null);
}

function reply($chatId, string $text, ?int $replyTo = null)
{
    $msg = null;
    foreach (mb_str_split($text, 4000) as $part) {     // Telegram allows 4096 characters
        $msg = tg('sendMessage', ['chat_id' => $chatId, 'text' => $part,
            'reply_to_message_id' => $replyTo, 'allow_sending_without_reply' => true]);
    }

    return $msg;
}

// ---------------------------------------------------------------- helpers
/** "2026-10-05T10:31:00Z" -> "16:31" in your timezone. */
function toLocal(string $iso): string
{
    global $TZ;

    return gmdate('H:i', strtotime($iso) + (int) round($TZ * 3600));
}

function arrow(string $d): string
{
    return in_array($d, ['CALL', 'BUY'], true) ? '🟢 CALL' : '🔴 PUT';
}

function resultIcon(string $result, int $level = 0): string
{
    if ($result === 'WIN') {
        return $level ? "✅ WIN (MTG $level)" : '✅ WIN';
    }

    return ['LOSS' => '❌ LOSS', 'NO_DATA' => '⚪ NO DATA'][$result] ?? $result;
}

// ---------------------------------------------------------------- commands
const HELP = "QUANTEX bot
/pairs - best paying open OTC pairs
/price EURUSD_otc - live price
/candles EURUSD_otc M5 10 - last candles
/check + your list on the next lines - WIN / LOSS
/results - today's QUANTEX results
/news - high impact news today
/future 18:00 22:00 - future signal list
/live on | /live off - live signals in this chat";

function command(string $name, array $args, string $text, $chatId): string
{
    global $BROKER, $TZ;
    switch ($name) {
        case 'start':
        case 'help':
            return HELP;

        case 'pairs':
            $lines = [];
            foreach (qx('GET', '/payouts', ['broker' => $BROKER, 'market' => 'otc']) as $p) {
                if ($p['open'] && count($lines) < 15) {
                    $lines[] = str_pad($p['name'], 18).' '.$p['payout'].'%';
                }
            }
            return $lines ? "Best payouts now:\n".implode("\n", $lines) : 'No open pair right now.';

        case 'price':
            if (! isset($args[0])) { return 'Write: /price EURUSD_otc'; }
            $t = qx('GET', '/ticks', ['broker' => $BROKER, 'pairs' => $args[0]])['ticks'][0];
            if (! $t['available']) { return "$args[0]: no live price right now."; }
            $out = "{$t['symbol']}  {$t['price']}\n".toLocal($t['time']).' (your time)';
            if ($c = $t['candle']) {
                $out .= "\nM1 candle: O {$c['open']}  H {$c['high']}  L {$c['low']}  · {$c['seconds_left']}s left";
            }
            return $out;

        case 'candles':
            if (! isset($args[0])) { return 'Write: /candles EURUSD_otc M5 10'; }
            $tf = strtoupper($args[1] ?? 'M1');
            $data = qx('GET', '/candles', ['broker' => $BROKER, 'pair' => $args[0], 'tf' => $tf, 'limit' => min((int) ($args[2] ?? 10), 30)]);
            $lines = [];
            $ups = 0;
            foreach ($data['candles'] as $c) {
                $up = $c['close'] >= $c['open'];
                $ups += $up ? 1 : 0;
                $lines[] = toLocal($c['time']).' '.($up ? '🟢' : '🔴')." O {$c['open']}  C {$c['close']}";
            }
            return "$args[0] $tf - last ".count($lines)." candles ($ups up, ".(count($lines) - $ups)." down)\n".implode("\n", $lines);

        case 'check':
            // Everything after the first line is the list, e.g. "M1 EURUSD-OTC 14:05 CALL"
            $signals = trim(implode("\n", array_slice(explode("\n", $text), 1)));
            if ($signals === '') {
                return "Send /check and your list on the next lines:\n/check\nM1 EURUSD-OTC 14:05 CALL\nM1 USDJPY-OTC 14:20 PUT";
            }
            $data = qx('POST', '/checker', [], ['broker' => $BROKER, 'text' => $signals, 'mtg' => 1, 'date' => 'today', 'timezone' => $TZ]);
            $lines = [];
            foreach ($data['results'] as $r) {
                $lines[] = "{$r['time']} {$r['pair']} ".arrow($r['direction']).' → '.resultIcon($r['result'], (int) ($r['mtg_level'] ?? 0));
            }
            $s = $data['summary'];
            $lines[] = "\nWins {$s['wins']} · Losses {$s['losses']} · Win rate {$s['win_rate']}%";
            if (! empty($data['rejected'])) { $lines[] = 'Not understood: '.count($data['rejected']).' line(s)'; }
            return implode("\n", $lines);

        case 'results':
            $data = qx('GET', '/results', ['broker' => $BROKER]);
            $s = $data['summary'];
            if (! $s['total']) { return "No settled QUANTEX signal yet on {$data['date']} (UTC)."; }
            return "QUANTEX live signals {$data['date']} (UTC)\n"
                ."Signals {$s['total']} · Wins {$s['wins']} · MTG wins {$s['mtg_wins']} · Losses {$s['losses']}\n"
                ."Win rate {$s['win_rate']}% (direct {$s['win_rate_no_mtg']}%)";

        case 'news':
            $lines = [];
            foreach (qx('GET', '/news', ['impact' => 'high', 'days' => 1, 'timezone' => $TZ])['events'] as $e) {
                $bias = ['bullish' => '⬆️', 'bearish' => '⬇️'][$e['bias'] ?? ''] ?? '•';
                $lines[] = toLocal($e['time'])." {$e['currency']} $bias {$e['title']}";
            }
            return $lines ? "High impact news today:\n".implode("\n", $lines) : 'No high impact news left today.';

        case 'future':
            [$start, $end] = [$args[0] ?? '00:00', $args[1] ?? '23:59'];
            $job = qx('POST', '/future', [], ['mode' => 'otc', 'broker' => $BROKER, 'start' => $start, 'end' => $end,
                'timezone' => $TZ, 'system' => 1, 'strategy' => 1, 'quantity' => 2]);
            for ($i = 0; $i < 30 && ! in_array($job['status'], ['done', 'failed'], true); $i++) {
                sleep(2);                                   // usually ready in a few seconds
                $job = qx('GET', '/jobs/'.$job['id']);
            }
            if ($job['status'] !== 'done') { return 'The list is not ready: '.($job['error']['message'] ?? $job['status']); }
            $lines = array_map(fn ($s) => "{$s['time']} {$s['pair']} ".arrow($s['direction']), $job['result']['signals']);
            return $lines ? "Future signals $start-$end:\n".implode("\n", $lines) : 'No signal in this time range.';

        case 'live':
            $subs = loadSubscribers();
            if (strtolower($args[0] ?? '') === 'off') {
                $subs = array_values(array_diff($subs, [$chatId]));
                saveSubscribers($subs);
                return 'Live signals stopped for this chat.';
            }
            saveSubscribers(array_values(array_unique([...$subs, $chatId])));
            return 'Live signals are on. Every new QUANTEX signal and its result is posted here.';
    }

    return 'Unknown command. Send /help';
}

function handle(array $message): void
{
    $text = $message['text'] ?? '';
    if ($text === '' || $text[0] !== '/') {
        return;
    }
    $first = preg_split('/\s+/', trim(explode("\n", $text)[0]));
    $name = strtolower(explode('@', substr($first[0], 1))[0]);
    try {
        $answer = command($name, array_slice($first, 1), $text, $message['chat']['id']);
    } catch (QuantexError $e) {
        $answer = '⚠️ '.$e->getMessage();
    } catch (Throwable $e) {
        $answer = '⚠️ Try again in a moment';
    }
    reply($message['chat']['id'], $answer, $message['message_id']);
}

// ---------------------------------------------------------------- live signals
function loadSubscribers(): array
{
    return is_file(SUBSCRIBERS_FILE) ? (json_decode(file_get_contents(SUBSCRIBERS_FILE), true) ?: []) : [];
}

function saveSubscribers(array $subs): void
{
    file_put_contents(SUBSCRIBERS_FILE, json_encode($subs));
}

/** One round of /v1/signals/live; $cursor and $posted keep their values between calls. */
function checkSignals(?int &$cursor, array &$posted): void
{
    global $BROKER;
    $params = ['broker' => $BROKER] + ($cursor !== null ? ['since' => $cursor] : []);
    $data = qx('GET', '/signals/live', $params);
    if ($cursor !== null) {                              // the first answer only sets the cursor
        $subs = loadSubscribers();
        foreach ($data['events'] as $ev) {
            $s = $ev['signal'];
            if ($ev['type'] === 'signal.created') {
                $text = "📊 {$s['pair']} · {$s['timeframe']}\n".arrow($s['direction'])."\n"
                    .'Entry '.toLocal($s['entry_at'])." · Payout {$s['payout']}% · Confidence {$s['confidence']}%";
                foreach ($subs as $c) {
                    $posted[$s['id']][$c] = reply($c, $text)['message_id'] ?? null;
                }
            } elseif ($ev['type'] === 'signal.result') {
                foreach ($subs as $c) {
                    reply($c, "{$s['pair']} {$s['direction']} → ".resultIcon($s['result'], (int) ($s['mtg_level'] ?? 0)), $posted[$s['id']][$c] ?? null);
                }
                unset($posted[$s['id']]);
            }
        }
    }
    $cursor = $data['next_cursor'];
}

// ---------------------------------------------------------------- main
$me = tg('getMe') ?? exit("Telegram token is not valid.\n");
echo "Bot @{$me['username']} is running. Press Ctrl+C to stop.\n";
$offset = 0;
$cursor = null;
$posted = [];
$nextSignals = 0;
while (true) {
    // Short long-poll (2 s) so the live signals are checked every few seconds too.
    foreach (tg('getUpdates', ['offset' => $offset, 'timeout' => 2]) ?? [] as $u) {
        $offset = $u['update_id'] + 1;
        if (isset($u['message'])) {
            handle($u['message']);
        }
    }
    if (time() >= $nextSignals) {
        try {
            checkSignals($cursor, $posted);
        } catch (Throwable $e) {
            echo 'signals: ', $e->getMessage(), "\n";
        }
        $nextSignals = time() + 3;
    }
}
