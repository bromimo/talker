<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class PaycardController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("*5457082297644556* Приватбанк Билошенко И.Е.")
        );
    }
}