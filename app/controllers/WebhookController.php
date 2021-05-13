<?php
namespace App\Controllers;

use App\Services\Bot\RequestHandler;
use App\Services\Curl;

class WebhookController
{
    public function set()
    {
        $res = RequestHandler::setWebhook();
        dd($res);
    }

    public function info()
    {
        $res = RequestHandler::getWebhookInfo();
        dd($res);
    }

    public function delete()
    {
        $res = RequestHandler::deleteWebhook();
        dd($res);
    }

    public function reset()
    {
        RequestHandler::deleteWebhook();
        RequestHandler::setWebhook();

        dd(RequestHandler::getWebhookInfo());
    }
}
