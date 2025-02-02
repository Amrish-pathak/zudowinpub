<?php

$apiKey = '5199784134:AAGggLmold59OUuoyyoaP8SJwZtt_-BVgWY';
$chat_id = 'YOUR_CHAT_ID';
$message = "Click the button below to visit our website!";

$apiUrl = "https://api.telegram.org/bot$apiKey/sendMessage";

// Define the inline keyboard buttons
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'Visit Website', 'url' => 'https://yourwebsite.com']
        ]
    ]
];

// Convert to JSON format
$reply_markup = json_encode($keyboard);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'Markdown',
    'reply_markup' => $reply_markup
]);

$result = curl_exec($ch);
curl_close($ch);

echo "Message sent!";

?>
