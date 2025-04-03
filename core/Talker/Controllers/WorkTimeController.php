<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class WorkTimeController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("Мы работаем с *8:30* до *19:00* по предварительной записи. Выходные четверг и воскресенье.")
        );
    }
}