<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class SterilizationController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("🧐 После каждого клиента инструменты замачиваются в дезактине 0,5% на 20 минут, промываются, обрабатываются стерилиумом и кладутся в сухожар.")
        );
    }
}