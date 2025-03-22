<?php

namespace core\Telegram\Components;

use core\Telegram\Traits\Arrayable;

class Keyboard
{
    use Arrayable;

    /** @var Button[][] */
    public array $inline_keyboard = [];

    private function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    public function buttons(array $buttons): self
    {
        $this->inline_keyboard = array_merge($this->inline_keyboard, $buttons);

        return $this;
    }

//    public static function fromArray(array $arrayKeyboard): Keyboard
//    {
//        $keyboard = self::make();
//
//        foreach ($arrayKeyboard as $buttons) {
//            $rowButtons = [];
//
//            foreach ($buttons as $button) {
//                $rowButton = Button::make($button['text']);
//
//                if (array_key_exists("callback_data", $button)) {
//                    $params = explode(";", $button['callback_data']);
//
//                    foreach ($params as $param) {
//                        $key = Str::of($param)->before(':');
//                        $value = Str::of($param)->after(':');
//
//                        $rowButton = $rowButton->param($key, $value);
//                    }
//                }
//
//                if (array_key_exists("url", $button)) {
//                    $rowButton = $rowButton->url($button['url']);
//                }
//
//                if (array_key_exists("web_app", $button)) {
//                    $rowButton = $rowButton->webApp($button['web_app']['url']);
//                }
//
//                if (array_key_exists("login_url", $button)) {
//                    $rowButton = $rowButton->loginUrl($button['login_url']['url']);
//                }
//
//                $rowButtons[] = $rowButton;
//            }
//
//            $keyboard = $keyboard->row($rowButtons);
//        }
//
//        return $keyboard;
//    }
}