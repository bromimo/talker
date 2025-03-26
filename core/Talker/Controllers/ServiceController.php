<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Photo;
use core\Telegram\Components\Button;
use core\Telegram\Components\Keyboard;
use core\Talker\Controllers\Abstracts\Controller;

class ServiceController extends Controller
{
    public function __invoke(array $params): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendPhoto(
            Photo::make(asset('img/map.jpg'))
                 ->caption("*Как нас найти*\n\nМы находимся по адресу:\nг.Днепр, ул.Пастера, 4а")
                 ->keyboard(
                     Keyboard::make()->buttons([
                         [
                             Button::make('Позвонить администратору   📞')->action('call_admin'),
                         ]
                     ])
                 )
        );
    }
}