<?php
namespace App\Controllers;

class WebhookController
{
    public function set()
    {
        $telBaseUrl = "https://api.telegram.org";
        $botToken = config('app.bot_token');
        dd($botToken);
    }

    public function info()
    {
        
    }

    public function delete()
    {
        
    }
}
