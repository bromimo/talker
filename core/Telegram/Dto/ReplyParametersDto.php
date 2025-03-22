<?php

namespace core\Telegram\Dto;

use core\Telegram\Enums\ParseModeEnum;
use Spatie\DataTransferObject\DataTransferObject;

final class ReplyParametersDto extends DataTransferObject
{
    public int             $message_id;
    public int|string|null $chat_id;
    public ?bool           $allow_sending_without_reply;
    public ?string         $quote;
    public ?ParseModeEnum  $quote_parse_mode;
    /** @var MessageEntityDto[] */
    public ?array $quote_entities;
    public ?int   $quote_position;
}