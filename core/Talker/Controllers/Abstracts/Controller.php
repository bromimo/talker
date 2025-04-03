<?php

namespace core\Talker\Controllers\Abstracts;

use core\Telegram\Telegram;
use core\Telegram\Dto\UserDto;
use core\Telegram\Components\Message;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class Controller
{
    /** Возвращает первое доступное имя или дефолтное значение.
     * @param string $default
     * @return string
     */
    public function getName(string $default = 'Незнакомец'): string
    {
        $tg = Telegram::getInstance();

        return $tg->first_name ?? $tg->last_name ?? $tg->username ?? $default;
    }

    /** Возвращает Имя и Фамилию или юзернейм, или дефолтное значение.
     * @param UserDto $user
     * @param string  $default
     * @return string
     */
    public function getTitle(UserDto $user, string $default = 'Незнакомец'): string
    {
        return trim("{$user->first_name} {$user->last_name}") ?: $user->username ?: $default;
    }

    /** Возвращает все реквизиты адресата.
     * @return string
     */
    public function getReqs(): string
    {
        $tg = Telegram::getInstance();

        return "{$tg->chat_id} {$tg->first_name} {$tg->last_name} {$tg->username}";
    }

    /** Возвращает текст сообщения.
     * @return string|null
     */
    public function getMessage(): ?string
    {
        $tg = Telegram::getInstance();

        return $tg->webhook->message?->text;
    }

    /** Отправляет сообщение администратору.
     * @param string $message
     * @return void
     * @throws UnknownProperties
     */
    public function sendAdmin(string $message): void
    {
        if ($admin_chat = config('bot.admin_chat')) {
            Telegram::sendMessage(
                Message::make($message)->chatId($admin_chat)
            );
        }
    }
}