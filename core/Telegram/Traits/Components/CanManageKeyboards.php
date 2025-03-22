<?php

namespace core\Telegram\Traits\Components;

use core\Telegram\Components\Keyboard;

trait CanManageKeyboards
{
    public function keyboard(callable|array|Keyboard $keyboard): self
    {
        if (is_callable($keyboard)) {
            $keyboard = $keyboard(Keyboard::make());
        }

//        if (is_array($keyboard)) {
//            $keyboard = Keyboard::fromArray($keyboard);
//        }

        $this->reply_markup = $keyboard;

        return $this;
    }

//    public function replyKeyboard(callable|array|ReplyKeyboard $keyboard): self
//    {
//
//
//        if (is_callable($keyboard)) {
//            $keyboard = $keyboard(ReplyKeyboard::make());
//        }
//
//        if (is_array($keyboard)) {
//            $keyboard = ReplyKeyboard::fromArray($keyboard);
//        }
//
//        data_set($telegraph->data, 'reply_markup.keyboard', $keyboard->toArray());
//
//        foreach ($keyboard->options() as $option_key => $option_value) {
//            data_set($telegraph->data, "reply_markup.$option_key", $option_value);
//        }
//
//        return $this;
//    }
//
//    public function forceReply(string $placeholder = '', bool $selective = false): self
//    {
//
//
//        $telegraph->data['reply_markup'] = ['force_reply' => true, 'selective' => $selective];
//
//        if ($placeholder !== '') {
//            if (strlen($placeholder) > 64) {
//                throw KeyboardException::maxPlaceholderLengthExcedeed($placeholder);
//            }
//
//            $telegraph->data['reply_markup']['input_field_placeholder'] = $placeholder;
//        }
//
//        return $this;
//    }
//
//    public function removeReplyKeyboard(bool $selective = false): self
//    {
//
//
//        $telegraph->data['reply_markup'] = [
//            'remove_keyboard' => true,
//            'selective' => $selective,
//        ];
//
//        return $this;
//    }
//
//    public function replaceKeyboard(int $messageId, Keyboard|callable $newKeyboard): self
//    {
//
//
//        if (is_callable($newKeyboard)) {
//            $newKeyboard = $newKeyboard(Keyboard::make());
//        }
//
//        if ($newKeyboard->isEmpty()) {
//            $replyMarkup = '';
//        } else {
//            $replyMarkup = ['inline_keyboard' => $newKeyboard->toArray()];
//        }
//
//        $telegraph->endpoint = self::ENDPOINT_REPLACE_KEYBOARD;
//        $telegraph->data = [
//            'chat_id' => $telegraph->getChatId(),
//            'message_id' => $messageId,
//            'reply_markup' => $replyMarkup,
//        ];
//
//        return $this;
//    }
//
//    public function deleteKeyboard(int $messageId): self
//    {
//
//
//        return $telegraph->replaceKeyboard($messageId, Keyboard::make());
//    }
}