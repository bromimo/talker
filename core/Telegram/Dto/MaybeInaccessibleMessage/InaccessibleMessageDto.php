<?php

namespace core\Telegram\Dto\MaybeInaccessibleMessage;

use core\Telegram\Dto\ChatDto;
use Spatie\DataTransferObject\DataTransferObject;

final class InaccessibleMessageDto extends DataTransferObject implements MaybeInaccessibleMessageInterface
{
    public ChatDto $chat;
    public int     $message_id;
    public int     $date;
}