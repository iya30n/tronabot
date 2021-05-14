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

        if ($input->getMessageType() === false)
            exit();

        if ($input->getMessageType() == 'message')
            $this->messageHandler($input);
        elseif($input->getMessageType() == 'inline_query')
            $this->queryHandler($input);
    }

    private function messageHandler($input)
    {
        $senderId = $input->getSenderId();

        $inputText = $input->getMessage();

        $translated = GoogleTranslator::translate($inputText);

        RequestHandler::replyTo($senderId, $translated);
    }

    private function queryHandler($input)
    {
        $senderId = $input->getQueryId();

        $inputText = $input->getQuery();

        $translated = GoogleTranslator::translate($inputText);

        RequestHandler::answerQuery($senderId, $translated);
    }
}
