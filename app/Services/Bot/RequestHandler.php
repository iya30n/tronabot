<?php

namespace App\Services\Bot;

use App\Services\Curl;

class RequestHandler
{
    private static $telApiUrl;
    private static $botToken;
    private static $appBaseUrl;

    private static function setUp()
    {
        static::$telApiUrl = config('app.tel_api_url');

        static::$botToken = config('app.bot_token');

        static::$appBaseUrl = config('app.base_url');
    }

    public static function urlGenerator($method)
    {
        static::setUp();

        return static::$telApiUrl . '/' . static::$botToken . '/' . $method;
    }

    public static function setWebhook()
    {
        $url = static::urlGenerator('setWebhook');

        $updateUrl = static::$appBaseUrl . '/getUpdate';

        $request = new Curl($url, "GET", [
            'url' => $updateUrl
        ]);

        $response = $request->send();

        return $response->getResult();
    }

    public static function getWebhookInfo()
    {
        $url = static::urlGenerator('getWebhookInfo');

        $request = new Curl($url);

        $response = $request->send();

        return $response->getResult();
    }

    public static function deleteWebhook()
    {
        $url = static::urlGenerator('deleteWebhook');

        $request = new Curl($url);

        $response = $request->send();

        return $response->getResult();
    }

    public static function replyTo(int $userId, string $text)
    {
        $url = static::urlGenerator('sendMessage');

        $request = new Curl($url, "GET", [
            'chat_id' => $userId,
            'text' => $text
        ]);

        $response = $request->send();

        return $response->getResult();
    }

    public static function answerQuery(string $queryId, string $text)
    {
        $url = static::urlGenerator('answerInlineQuery');

        $qres = [
            [
                'type' => 'article',
                'id' => "00" . rand(1, 9),
                'title' => $text,
                'input_message_content' => [
                    'message_text' => $text,
                ]
            ]
        ];

        $request = new Curl($url, "GET", [
            'inline_query_id' => (string)$queryId,
            'results' => json_encode($qres),
            'cache_time' => 0
        ]);

        $response = $request->send();

        return $response->getResult();
    }
}
