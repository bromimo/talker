<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Button;
use core\Telegram\Components\Message;
use core\Telegram\Components\Keyboard;
use core\Talker\Controllers\Abstracts\Controller;

class StartController extends Controller
{
    public function __invoke(string $param): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make('Привет!')->keyboard(
                Keyboard::make()->buttons([
                    [
                        Button::make('Моя запись ... 📖')->action('record'),
                        Button::make('Хочу узнать ... ℹ')->action('help'),
                    ],
                    [
                        Button::make('Позвонить администратору   📞')->action('call_admin'),
                    ]
                ])
            )
        );
    }
}