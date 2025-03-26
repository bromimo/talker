<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class CallAdminController extends Controller
{
    public function __invoke(): void
    {
        $phone = config('bot.admin_phone');
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("Звонок администратору: *{$phone}*")
        );
    }
}