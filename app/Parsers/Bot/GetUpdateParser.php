<?php

namespace App\Parsers\Bot;

class GetUpdateParser
{
    private static $input;

    public static function defineInput($input)
    {
        static::$input = json_decode($input, true);
        return new static;
    }

    public function getSenderId()
    {
        return static::$input['message']['from']['id'] ?? static::$input['message']['chat']['id']; 
    }

    public function getUserMessage()
    {
        return static::$input['message']['text'];
    }
}