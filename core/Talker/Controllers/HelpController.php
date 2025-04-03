<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Button;
use core\Telegram\Components\Message;
use core\Telegram\Components\Keyboard;
use core\Talker\Controllers\Abstracts\Controller;

class HelpController extends Controller
{
    public function __invoke(): void
    {

        Telegram::deletePreviousMessage();
        Telegram::sendMessage(
            Message::make("👨‍🎓 *{$this->getName('Незнакомец')}*, что бы вы хотели узнать?")->keyboard(
                Keyboard::make()->buttons([
                    [
                        Button::make('🗺   Как нас найти?')->action('map'),
                        Button::make('🕑   График работы')->action('schedule'),
                    ],
                    [
                        Button::make('💳   Можно оплатить на карту?')->action('cashless'),
                    ],
                    [
                        Button::make('💶   Наши цены')->action('price'),
                        Button::make('🧴   Стерилизация')->action('sterilization'),
                    ],
                    [
                        Button::make('🧖‍♀️   Наши услуги')
                              ->action('services')
                              ->param('d', date('Y-m-d'))
                              ->param('t', time()),
                    ],
                ])
            )
        );
    }
}