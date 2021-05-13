<?php
namespace App\Controllers;

use App\Parsers\Bot\GetUpdateParser;
use App\Services\Bot\RequestHandler;
use App\Services\Translators\GoogleTranslator;

class BotController
{
    public function getUpdate()
    {
        $input = GetUpdateParser::defineInput(
            file_get_contents('php://input')
        );

        $senderId = $input->getSenderId();

        $inputText = $input->getUserMessage();

        $translated = GoogleTranslator::translate($inputText);

        RequestHandler::replyTo($senderId, $translated);
    }
}
