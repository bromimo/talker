<?php

namespace core\Telegram\Dto\MessageOrigin;

use core\Telegram\Dto\ChatDto;
use Spatie\DataTransferObject\DataTransferObject;

final class MessageOriginChatDto extends DataTransferObject implements MessageOriginInterface
{
    public string  $type;
    public int     $date;
    public ChatDto $sender_chat;
    public ?string $author_signature;
}