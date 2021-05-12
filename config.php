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
        'bot_token' => 'bot'.'999857363:AAEetlgDmvn2PVRnjAFKCeLCcAienWxtXxc',
        'base_url' => 'https://b6c7d4ed9c56.ngrok.io'
    ]
];
