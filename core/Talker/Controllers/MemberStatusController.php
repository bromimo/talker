<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Dto\UserDto;
use core\Telegram\Components\Message;
use core\Talker\Controllers\Abstracts\Controller;

class MemberStatusController extends Controller
{
    public function member(array $users): void
    {
        $names = array_map(fn($user) => wrap($this->getTitle($user), '*'), $users);
        Telegram::sendMessage(
            Message::make("Приветствуем новых участников чата!\n" . implode(",\n", $names))
        );
    }

    public function left(UserDto $user): void
    {
        Telegram::sendMessage(
            Message::make("Нас покинул *{$this->getTitle($user)}*!.")
        );
    }
}