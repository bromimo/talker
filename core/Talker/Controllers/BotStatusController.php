<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class BotStatusController extends Controller
{
    public function member(): void
    {
        Telegram::sendMessage(
            Message::make('Приветствую! Я бот.')
        );
    }
}