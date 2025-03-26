<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class GetController extends Controller
{
    public function me(string $param): void
    {dd('me');
        Telegram::sendMessage(
            Message::make("Это команда /get с параметром {$param}")
        );
    }

    public function bot(string $param): void
    {dd('bot');
        Telegram::sendMessage(
            Message::make("Это команда /get с параметром {$param}")
        );
    }
}