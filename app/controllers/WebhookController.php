<?php
namespace App\Controllers;

use App\Services\Curl;

class WebhookController
{
    private $telApiUrl;
    private $botToken;
    private $appBaseUrl;

    public function __construct()
    {
        $this->telApiUrl = config('app.tel_api_url');

        $this->botToken = config('app.bot_token');

        $this->appBaseUrl = config('app.base_url');
    }

    private function urlGenerator($method)
    {
        return $this->telApiUrl . '/' . $this->botToken . '/' . $method;
    }

    public function set()
    {
        $url = $this->urlGenerator('setWebhook');

        $updateUrl = $this->appBaseUrl . '/getUpdate';

        $request = new Curl($url, "GET", [
            'url' => $updateUrl
        ]);

        $response = $request->send();

        dd($response->getResult());
    }

    public function info()
    {
        $url = $this->urlGenerator('getWebhookInfo');

        $request = new Curl($url);

        $response = $request->send();

        dd($response->getResult());
    }

    public function delete()
    {
        $url = $this->urlGenerator('deleteWebhook');

        $request = new Curl($url);

        $response = $request->send();

        dd($response->getResult());
    }
}
