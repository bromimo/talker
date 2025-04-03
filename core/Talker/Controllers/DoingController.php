<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Message;
use core\Talker\Traits\CanSearchLexeme;
use core\Talker\Controllers\Abstracts\Controller;

class DoingController extends Controller
{
    use CanSearchLexeme;

    public function __invoke()
    {
        $text = $this->getMessage();

        $actions = [
            'Делаем'     => 'делаете',
            'Рисуем'     => 'рисуете',
            'Наращиваем' => 'наращиваете'
        ];

        $types = ['аппаратный', 'апаратный', 'френч', 'фрэнч', 'ногти', 'ногтях', 'кислотный'];

        if (!($action = $this->arraySearchKey($actions, $text))
            || !$this->arraySearch($types, $text)
        ) {
            return;
        }

        Telegram::sendMessage(
            Message::make($action)
        );
    }
}