<?php

namespace core\Telegram\Components;

use core\Telegram\Dto\LoginUrlDto;
use core\Telegram\Traits\Arrayable;
use core\Telegram\Dto\WebAppInfoDto;

class Button
{
    use Arrayable;
    
    private string                         $url;
    private string                         $callback_data;
    private WebAppInfoDto                  $web_app;
    private LoginUrlDto                    $login_url;
    private string                         $switch_inline_query;
    private string                         $switch_inline_query_current_chat;
//    private SwitchInlineQueryChosenChatDto $switch_inline_query_chosen_chat;
//    private CopyTextButtonDto              $copy_text;
//    private CallbackGameDto                $callback_game;
//    private bool                           $pay;

    private function __construct(
        private string $text,
    ) {
    }

    public static function make(string $label): self
    {
        return new static($label);
    }

    public function action(string $name): self
    {
        return $this->param('action', $name);
    }

    public function param(string $key, int|string $value): self
    {
        $key = trim($key);
        $value = trim((string) $value);

        $this->callbackData[] = "$key:$value";

        return $this;
    }

    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function webApp(string $url): self
    {
        $this->webAppUrl = new WebAppInfoDto($url);

        return $this;
    }

    public function loginUrl(string $url): self
    {
        $this->loginUrl = new LoginUrlDto($url);

        return $this;
    }

    public function toArray(): array
    {
        if (!empty($this->callbackData)) {
            $this->callback_data = implode(';', $this->callbackData);
        }

        return array_filter(
            $this->mapValue(get_object_vars($this)),
            static fn($value) => $value !== null
        );
    }
}