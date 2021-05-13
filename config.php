<?php

return [
    'database' => [
        'name' => 'botapp',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1;',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'app' => [
        'tel_api_url' => "https://api.telegram.org",
        'bot_token' => 'bot'.'999857363:AAEetlgDmvn2PVRnjAFKCeLCcAienWxtXxc',
        'base_url' => 'https://b3be58bde757.ngrok.io'
    ]
];
