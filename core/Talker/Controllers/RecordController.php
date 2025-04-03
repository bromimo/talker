<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class RecordController extends Controller
{
    public function my(): void
    {
        Telegram::sendMessage(
            Message::make('Вы хотите получить информацию о своей записи')
        );
    }

    public function delete(): void
    {
        Telegram::sendMessage(
            Message::make('Вы хотите удалить запись')
        );
    }
}