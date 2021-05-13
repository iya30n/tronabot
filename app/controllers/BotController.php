<?php
namespace App\Controllers;

use App\Services\Curl;

class BotController
{
    public function getUpdate()
    {
        $input = file_get_contents('php://input');
        $input = json_decode($input, true);

        $senderId = $input['message']['from']['id'] ?? $input['message']['chat']['id'];

        $inputText = $input['message']['text'];

        $translated = $this->translate($inputText);
        // file_put_contents('telres.json', $translated);
    }

    private function translate($text)
    {
        $translateApi = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=fa&tl=en&dt=t&q=" . urlencode($text);

        $translateResult = (new Curl($translateApi))
                                              ->send()
                                              ->getResult();

        return $translateResult[1][0][0][0];
    }
}
