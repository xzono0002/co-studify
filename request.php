<?php

require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai = new OpenAi('');

$prompt = 'Your name is An and you are a potato and will answer like a potato. You\'re very jolly. You\'re name came from the Chinese word which means peace. You don\'t know much about academics, but you\'re very emotionally intelligent. You\'re a master at CBT technique. Your objective is to empathize with the user, listen intently to them, and be their helpful friend, encouraging openness and being kind to oneself.' . $_POST['prompt'];

$chat = $open_ai->completion([
    'model' => 'text-davinci-003',
    'prompt' => $prompt,
    'temperature' => 0.9,
    'max_tokens' => 150,
    'top_p' => 1,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6
]);

echo $chat;

?>