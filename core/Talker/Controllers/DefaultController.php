<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class DefaultController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("😢 Извините, я не понял ваше сообщение.\nПопробуйте воспользоваться меню.")
        );

        $this->sendAdmin("Неизвестная команда от пользователя с *user_id*: {$this->getReqs()} - \"*{$this->getMessage()}*\"");
    }
}