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

    public function getMessageType()
    {
        if (in_array(static::$input, [null, ""]))
            return false;

        if (isset(static::$input['message']) == false && isset(static::$input['inline_query']) == false)
            return false;

        if (array_key_exists('message', static::$input))
            return 'message';
        else if (array_key_exists('inline_query', static::$input))
            return 'inline_query';
    }

    public function getMessage()
    {
        return static::$input['message']['text'];
    }

    public function getQuery()
    {
        return static::$input['inline_query']['query'];
    }

    public function getSenderId()
    {
        return static::$input[$this->getMessageType()]['from']['id'];
    }

    public function getQueryId()
    {
        return static::$input[$this->getMessageType()]['id'];
    }
}