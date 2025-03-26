<?php

namespace core\Telegram\Components;

use core\Telegram\Traits\Arrayable;
use core\Telegram\Dto\ForceReplyDto;
use core\Telegram\Enums\ParseModeEnum;
use core\Telegram\Dto\MessageEntityDto;
use core\Telegram\Dto\ReplyParametersDto;
use core\Telegram\Dto\LinkPreviewOptionsDto;
use core\Telegram\Dto\ReplyKeyboardMarkupDto;
use core\Telegram\Dto\ReplyKeyboardRemoveDto;
use core\Telegram\Traits\Components\CanManageKeyboards;

class Message
{
    use Arrayable, CanManageKeyboards;

    public int|string    $chat_id;
    public string        $text;
    public string        $business_connection_id;
    public int           $message_thread_id;
    public ParseModeEnum $parse_mode;

    /** @var MessageEntityDto[] */
    public array                 $entities;
    public LinkPreviewOptionsDto $link_preview_options;
    public bool                  $disable_notification;
    public bool                  $protect_content;
    public bool                  $allow_paid_broadcast;
    public string                $message_effect_id;
    public ReplyParametersDto    $reply_parameters;

    public Keyboard|ReplyKeyboardMarkupDto|ReplyKeyboardRemoveDto|ForceReplyDto $reply_markup;

    private function __construct(string $text)
    {
        $this->text = $text;
        $this->parse_mode = ParseModeEnum::Markdown;
    }

    public static function make(string $text): self
    {
        return new self($text);
    }

    public function chatId(int|string $chat_id): self
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /** Режим форматирования текста.
     * @param ParseModeEnum $mode
     * @return $this
     */
    public function parseMode(ParseModeEnum $mode): self
    {
        $this->parse_mode = $mode;

        return $this;
    }
}