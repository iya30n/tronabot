<?php
namespace App\Controllers;

use App\Services\Curl;

class WebhookController
{
    public function set()
    {
        $telBaseUrl = "https://api.telegram.org";
        $botToken = config('app.bot_token');

        $baseUrl = config('app.base_url');
        
        $request = new Curl("$telBaseUrl/$botToken/setWebhook", "GET", [
            'url' => "$baseUrl/getUpdate"
        ]);

        $response = $request->send()->getResult();

        dd($response);
    }

    public function info()
    {
        
    }

    public function delete()
    {
        
    }
}
