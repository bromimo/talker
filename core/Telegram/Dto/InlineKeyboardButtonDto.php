<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class InlineKeyboardButtonDto extends DataTransferObject
{
    public string  $text;
    public ?string $url;
    public ?string $callback_data;
    public ?WebAppInfoDto $web_app;
    public ?LoginUrlDto $login_url;
    public ?string $switch_inline_query;
    public ?string $switch_inline_query_current_chat;
    public ?SwitchInlineQueryChosenChatDto $switch_inline_query_chosen_chat;
    public ?CopyTextButtonDto $copy_text;
    public ?CallbackGameDto $callback_game;
    public ?bool $pay;
}