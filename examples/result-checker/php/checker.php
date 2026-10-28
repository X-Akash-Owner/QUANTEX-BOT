<?php
/*
 * QUANTEX API - result checker from a file (PHP 8.0+, curl extension)
 *
 * Reads signals.txt (one signal per line, e.g. "M1 EURUSD-OTC 14:05 CALL"),
 * checks every signal with POST /v1/checker and writes results.csv.
 *
 * Run
 *   export QX_API_KEY="qx_live_..."      (Windows: set QX_API_KEY=qx_live_...)
 *   php checker.php                      today, times in UTC+6
 *   php checker.php 2026-10-04 5.5       another day and timezone
 */
$api = getenv('QX_API') ?: 'https://api.quantexbot.pro/v1';
$key = getenv('QX_API_KEY');
$day = $argv[1] ?? 'today';               // today, yesterday or YYYY-MM-DD (30 days back)
$tz = (float) ($argv[2] ?? 6);            // UTC offset of the times in the list

$ch = curl_init("$api/checker");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Authorization: Bearer $key", 'Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode(['broker' => 'quotex', 'text' => file_get_contents(__DIR__.'/signals.txt'),
        'mtg' => 1, 'date' => $day, 'timezone' => $tz]),
]);
$answer = json_decode((string) curl_exec($ch), true);
curl_close($ch);
if (empty($answer['ok'])) {
    exit('Error '.($answer['error']['code'] ?? 'network').': '.($answer['error']['message'] ?? 'no answer')."\n");
}

$data = $answer['data'];
printf("%-6s %-14s %-5s %s\n", 'TIME', 'PAIR', 'DIR', 'RESULT');
foreach ($data['results'] as $x) {
    $mtg = $x['result'] === 'WIN' && ! empty($x['mtg_level']) ? " (MTG {$x['mtg_level']})" : '';
    printf("%-6s %-14s %-5s %s%s\n", $x['time'], $x['pair'], $x['direction'], $x['result'], $mtg);
}
$s = $data['summary'];
echo "\nTotal {$s['total']} | Wins {$s['wins']} | Losses {$s['losses']} | No data {$s['no_data']} | Win rate {$s['win_rate']}%\n";
foreach ($data['rejected'] as $line) {
    echo 'Not understood: ', is_string($line) ? $line : json_encode($line), "\n";
}

$f = fopen(__DIR__.'/results.csv', 'w');
fputcsv($f, ['time', 'pair', 'direction', 'timeframe', 'result', 'mtg_level', 'payout']);
foreach ($data['results'] as $x) {
    fputcsv($f, [$x['time'], $x['pair'], $x['direction'], $x['timeframe'], $x['result'], $x['mtg_level'] ?? '', $x['payout'] ?? '']);
}
fclose($f);
echo "Saved results.csv\n";
