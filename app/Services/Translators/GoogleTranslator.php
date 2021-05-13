<?php

namespace App\Services\Translators;

use App\Services\Curl;

class GoogleTranslator
{
    private static $translateApi = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=fa&tl=en&dt=t&q=";

    public static function translate($text)
    {
        $url = static::$translateApi . urlencode($text);

        $translateResult = (new Curl($url))
            ->send()
            ->getResult();

        return $translateResult[1][0][0][0];
    }
}
