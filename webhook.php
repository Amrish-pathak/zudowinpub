<?php

$apiKey = '5199784134:AAGggLmold59OUuoyyoaP8SJwZtt_-BVgWY'; // Your Telegram bot API key
$apiUrl = "https://api.telegram.org/bot$apiKey/";

// Get the incoming message
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Extract necessary information from the update
$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];
$message_id = $update['message']['message_id'];

// Check if the received message is the "/start" command
if ($text === '/start') {

    // Debugging: Check if the file exists
    // If you want to use a local image, specify its path here
    $photoUrl = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.hollywoodreporter.com%2Fnews%2Fgeneral-news%2Fwhy-img-worldwide-is-being-400544%2F&psig=AOvVaw12t74pDLciE2SvPfuEVz_P&ust=1738585772503000&source=images&cd=vfe&opi=89978449&ved=2ahUKEwjZn6ns_qSLAxU5k2MGHfYDENsQjRx6BAgAEBk'; // Replace with the URL of the image

    // Set the caption for the message
    $caption = "
    👋 **Welcome to the GamaDog Adventure!** 🐾🎮

    Get ready for a tail-wagging journey where every paw-tap leads to bigger rewards! Here’s what’s waiting for you:

    ✨ **Play GamaDog**: Tap the dog bone and watch your balance fetch amazing rewards!
    🐕 **Mine for PUPS**: Collect GamaDog Tokens with every action your furry friend takes.
    📋 **Complete Doggy Tasks**: Help your pup finish fun missions and earn even more treats!
    🏆 **Climb the Leaderboard**: Compete with other pups and rise to the top to show you’re the best in the pack!
    👥 **Invite Your Pack & Earn More!**  
    Got friends, family, or fellow dog lovers? Invite them to join the fun and grow your earnings as the pack gets bigger! The more paws, the better!

    🔗 **Connect with Us:**
    - Developed by [@itking007](https://t.me/itking007)
    - Join our [Dog Lovers Telegram Pack](https://t.me/companybrodigital) for the latest updates and tail-wagging fun!

    🐾 **Get Started Now** and take your dog on the ultimate GamaDog adventure!

    👉 [Join Our Doggo Community](https://t.me/companybrodigital)
    ";

    // Initialize cURL to send the photo
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl . "sendPhoto");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => $photoUrl, // Use URL for the photo
        'caption' => $caption,
        'parse_mode' => 'Markdown', // Use Markdown for basic formatting
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => 'Play GamaDog Now', 'web_app' => ['url' => 'https://app.companybro.com']],
                    ['text' => 'Join Our Community', 'url' => 'https://t.me/companybrodigital']
                ]
            ]
        ])
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $result = curl_exec($ch);

    if ($result === false) {
        error_log("CURL Error: " . curl_error($ch));
    } else {
        // Optionally, log the result for debugging
        error_log("Result: " . $result);
    }

    curl_close($ch);
}
?>
