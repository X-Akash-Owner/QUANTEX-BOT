<?php
/*
 * QUANTEX API - data for index.html (PHP 8.0+, curl extension)
 *
 * Put index.html and this file in one folder of your website (XAMPP: htdocs/chart).
 * Write your key below (or set QX_API_KEY). The browser never sees the key.
 *   api.php?do=pairs                       open pairs with payout
 *   api.php?do=candles&pair=..&tf=M1       candles [[epoch, open, high, low, close], ...]
 *   api.php?do=tick&pair=..                newest live tick
 * Answers are cached for a moment, so 1 or 1000 visitors make the same few API requests.
 */
const QX_API = 'https://api.quantexbot.pro/v1';
const BROKER = 'quotex';                                   // quotex or tradowix (live ticks)
$key = getenv('QX_API_KEY') ?: 'qx_live_PUT_YOUR_KEY_HERE';
$api = getenv('QX_API') ?: QX_API;

header('Content-Type: application/json');
header('Cache-Control: no-store');

function answer(bool $ok, $data): void
{
    echo json_encode($ok ? ['ok' => true, 'data' => $data] : ['ok' => false, 'error' => $data]);
    exit;
}

/** GET from the QUANTEX API, with a small file cache shared by all visitors. */
function quantex(string $path, array $query, float $cacheSeconds)
{
    global $key, $api;
    $file = sys_get_temp_dir().'/qx-'.md5($path.'?'.http_build_query($query)).'.json';
    $cached = is_file($file) ? json_decode((string) file_get_contents($file), true) : null;
    if ($cached && microtime(true) - $cached['t'] < $cacheSeconds) {
        return $cached['d'];
    }
    $ch = curl_init($api.$path.'?'.http_build_query($query));
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15, CURLOPT_HTTPHEADER => ["Authorization: Bearer $key"]]);
    $body = json_decode((string) curl_exec($ch), true);
    curl_close($ch);
    if (empty($body['ok'])) {
        answer(false, $body['error']['message'] ?? 'QUANTEX API not reachable');
    }
    file_put_contents($file, json_encode(['t' => microtime(true), 'd' => $body['data']]), LOCK_EX);

    return $body['data'];
}

// Only accept what the page needs: nobody can use your key for anything else.
$pair = preg_match('/^[A-Za-z0-9_]{3,30}$/', $_GET['pair'] ?? '') ? $_GET['pair'] : null;
$tf = in_array($_GET['tf'] ?? 'M1', ['M1', 'M5', 'M15', 'M30', 'H1', 'H4'], true) ? ($_GET['tf'] ?? 'M1') : 'M1';
$limit = max(1, min(1000, (int) ($_GET['limit'] ?? 500)));

switch ($_GET['do'] ?? '') {
    case 'pairs':
        $pairs = quantex('/pairs', ['broker' => BROKER, 'open' => 'true'], 60);
        usort($pairs, fn ($a, $b) => ($b['payout'] ?? 0) <=> ($a['payout'] ?? 0));
        answer(true, array_map(fn ($p) => ['symbol' => $p['symbol'], 'name' => $p['name'], 'payout' => $p['payout']], $pairs));

    case 'candles':
        $pair || answer(false, 'pair missing');
        $data = quantex('/candles', ['broker' => BROKER, 'pair' => $pair, 'tf' => $tf, 'limit' => $limit], 5);
        answer(true, array_map(fn ($c) => [$c['epoch'], $c['open'], $c['high'], $c['low'], $c['close']], $data['candles']));

    case 'tick':
        $pair || answer(false, 'pair missing');
        answer(true, quantex('/ticks', ['broker' => BROKER, 'pairs' => $pair], 0.4)['ticks'][0]);
}
answer(false, 'unknown request');
