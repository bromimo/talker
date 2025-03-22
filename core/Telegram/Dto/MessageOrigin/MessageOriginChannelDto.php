<?php

namespace core\Telegram\Dto\MessageOrigin;

use core\Telegram\Dto\ChatDto;
use Spatie\DataTransferObject\DataTransferObject;

final class MessageOriginChannelDto extends DataTransferObject implements MessageOriginInterface
{
    public string  $type;
    public int     $date;
    public ChatDto $chat;
    public int     $message_id;
    public ?string $author_signature;
}