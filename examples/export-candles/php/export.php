<?php
/*
 * QUANTEX API - download historical candles to a CSV file (PHP 8.0+, curl extension)
 *
 * GET /v1/history gives every closed candle of whole UTC days. M1 allows 7 days
 * per request, M5 and higher 31 days, so a long range is fetched in parts.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   php export.php EURUSD_otc M1 2026-09-01 2026-09-30
 *   -> EURUSD_otc_M1_2026-09-01_2026-09-30.csv
 */
$api = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$key = getenv('QX_API_KEY');
$broker = getenv('QX_BROKER') ?: 'quotex';
if ($argc < 5) {
    exit("Use: php export.php PAIR TIMEFRAME FROM TO   e.g. EURUSD_otc M1 2026-09-01 2026-09-30\n");
}
[, $pair, $tf, $first, $last] = $argv;
$tf = strtoupper($tf);
$step = $tf === 'M1' ? 7 : 31;                    // days per request

$out = "{$pair}_{$tf}_{$first}_{$last}.csv";
$file = fopen($out, 'w');
fputcsv($file, ['time_utc', 'epoch', 'open', 'high', 'low', 'close', 'payout', 'volume']);
$day = new DateTimeImmutable($first, new DateTimeZone('UTC'));
$end = new DateTimeImmutable($last, new DateTimeZone('UTC'));
$total = 0;
while ($day <= $end) {
    $to = min($day->modify('+'.($step - 1).' days'), $end);
    $query = http_build_query(['broker' => $broker, 'pair' => $pair, 'tf' => $tf, 'from' => $day->format('Y-m-d'), 'to' => $to->format('Y-m-d')]);
    $ch = curl_init("$api/history?$query");
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 120, CURLOPT_HTTPHEADER => ["Authorization: Bearer $key"]]);
    $answer = json_decode((string) curl_exec($ch), true);
    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    if ($status === 429) {                          // too many requests: wait and ask again
        sleep(5);
        continue;
    }
    if (empty($answer['ok'])) {
        exit('Error '.($answer['error']['code'] ?? 'network').': '.($answer['error']['message'] ?? 'no answer')."\n");
    }
    foreach ($answer['data']['candles'] as $c) {
        fputcsv($file, [$c['time'], $c['epoch'], $c['open'], $c['high'], $c['low'], $c['close'], $c['payout'], $c['volume']]);
    }
    $total += $answer['data']['count'];
    echo $day->format('Y-m-d'), ' .. ', $to->format('Y-m-d'), ": {$answer['data']['count']} candles\n";
    $day = $to->modify('+1 day');
}
fclose($file);
echo "Saved $total candles to $out\n";
