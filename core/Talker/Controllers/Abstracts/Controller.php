<?php

namespace core\Talker\Controllers\Abstracts;

use core\Telegram\Telegram;

abstract class Controller
{
    /** Возвращает первое доступное имя или дефолтное значение.
     * @param string $default
     * @return string
     */
    public function getName(string $default = ''): string
    {
        $tg = Telegram::getInstance();

        return $tg->first_name ?? $tg->last_name ?? $tg->username ?? $default;
    }
}