<?php

namespace core\Telegram\Components;

use core\Telegram\Traits\Arrayable;
use core\Telegram\Dto\ForceReplyDto;
use core\Telegram\Enums\ParseModeEnum;
use core\Telegram\Dto\MessageEntityDto;
use core\Telegram\Dto\ReplyParametersDto;
use core\Telegram\Dto\ReplyKeyboardMarkupDto;
use core\Telegram\Dto\ReplyKeyboardRemoveDto;
use core\Telegram\Traits\Components\CanManageKeyboards;

class Photo
{
    use Arrayable, CanManageKeyboards;

    public string        $business_connection_id;
    public int|string    $chat_id;
    public int           $message_thread_id;
    public string        $photo;
    public string        $caption;
    public ParseModeEnum $parse_mode;

    /** @var MessageEntityDto[] */
    public array $caption_entities;

    public bool   $show_caption_above_media;
    public bool   $has_spoiler;
    public bool   $disable_notification;
    public bool   $protect_content;
    public bool   $allow_paid_broadcast;
    public string $message_effect_id;

    public ReplyParametersDto $reply_parameters;

    public Keyboard|ReplyKeyboardMarkupDto|ReplyKeyboardRemoveDto|ForceReplyDto $reply_markup;

    private function __construct(string $photo_url)
    {
        $this->photo = $photo_url;
        $this->parse_mode = ParseModeEnum::Markdown;
    }

    public static function make(string $photo_url): self
    {
        return new self($photo_url);
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

    /** Добавляет подпись к изображению.
     * @param string $caption
     * @return $this
     */
    public function caption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /** Показывать подпись над изображением.
     * @param bool $condition
     * @return $this
     */
    public function showCaptionAboveMedia(bool $condition = true): self
    {
        $this->show_caption_above_media = $condition;

        return $this;
    }

    /** Изображение скрыто спойлером.
     * @param bool $condition
     * @return $this
     */
    public function hasSpoiler(bool $condition = true): self
    {
        $this->has_spoiler = $condition;

        return $this;
    }
}