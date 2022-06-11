<?php

$url = 'http://localhost:8899';
$request_url = $url . '/synthesize/';
$r = microtime(1);

$data = [
    'text'  => 'Полноценный нормализатор текста для раскрытия чисел, аббревиатур и сокращений;',
    'voice' => 'Ruslan',
];

// use key 'http' even if you send the request to https://...
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];
$context = stream_context_create($options);
$result = json_decode(file_get_contents($request_url, false, $context), JSON_OBJECT_AS_ARRAY);
if ($result) {
    file_put_contents('audio.wav', file_get_contents($url . $result['response'][0]['response_audio_url']));
    echo "done ". (microtime(1)-$r);
} else {
    var_dump($result);
}


