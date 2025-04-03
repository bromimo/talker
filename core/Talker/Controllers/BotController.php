<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class BotController extends Controller
{
    public function __invoke(array $matches): void
    {
        $pattern = substr($matches[0],2,-2);

        Telegram::sendMessage(
            Message::make("😊 Чт{$pattern}?")
        );
    }
}