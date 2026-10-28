<?php
/*
 * QUANTEX API - webhook receiver (PHP 8.0+)
 *
 * Put this file on your website (e.g. https://your-domain/quantex-webhook.php)
 * and add that address in Dashboard -> API -> Webhooks. QUANTEX POSTs every new
 * signal (signal.created) and its result (signal.result); this file checks the
 * signature and forwards the signal to your Telegram channel.
 *
 * Settings: write them below, or set them as environment variables.
 */
$secret = getenv('QX_WEBHOOK_SECRET') ?: 'whsec_PUT_YOUR_SECRET_HERE';   // shown once when you add the webhook
$tgToken = getenv('TG_BOT_TOKEN') ?: '';                                  // optional: post to Telegram
$tgChat = getenv('TG_CHAT') ?: '';                                        // optional, e.g. @your_channel

$raw = file_get_contents('php://input');           // the raw body: the signature is made over it

// X-Quantex-Signature: t=<unix time>,v1=<hex HMAC-SHA256 of "<t>.<raw body>">
parse_str(str_replace(',', '&', $_SERVER['HTTP_X_QUANTEX_SIGNATURE'] ?? ''), $sig);
$t = $sig['t'] ?? '';
$expected = hash_hmac('sha256', $t.'.'.$raw, $secret);
if (! ctype_digit($t) || abs(time() - (int) $t) > 300 || ! hash_equals($expected, $sig['v1'] ?? '')) {
    http_response_code(401);
    exit;
}

// Retries send the same delivery id: handle each one once.
$delivery = preg_replace('/[^A-Za-z0-9_-]/', '', $_SERVER['HTTP_X_QUANTEX_DELIVERY'] ?? '');
$seenFile = sys_get_temp_dir().'/quantex-delivery-'.$delivery;
if ($delivery === '' || file_exists($seenFile)) {
    http_response_code(200);
    exit;
}
touch($seenFile);

$event = json_decode($raw, true);
$s = $event['data'];
if ($event['type'] === 'signal.created') {
    $text = "📊 {$s['pair']} {$s['timeframe']} {$s['direction']} - entry ".substr($s['entry_at'], 11, 5)." UTC, payout {$s['payout']}%";
} elseif ($event['type'] === 'signal.result') {
    $text = "{$s['pair']} {$s['direction']}: {$s['result']}".(! empty($s['mtg_level']) ? " (MTG {$s['mtg_level']})" : '');
} else {
    $text = 'QUANTEX webhook test received ✅';         // "ping" from the Send test button
}
file_put_contents(__DIR__.'/quantex-events.log', date('c').' '.$text."\n", FILE_APPEND);

if ($tgToken && $tgChat) {
    $ch = curl_init("https://api.telegram.org/bot$tgToken/sendMessage");
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 4, CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode(['chat_id' => $tgChat, 'text' => $text])]);
    curl_exec($ch);
    curl_close($ch);
}
http_response_code(200);                            // answer 2xx within 5 seconds
