<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class GreetingController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("😊 Здравствуйте, *{$this->getName()}*!\nЧем я могу быть вам полезен?")
        );
    }
}