<?php

namespace core\Telegram\Dto\MessageOrigin;

use Spatie\DataTransferObject\DataTransferObject;

final class MessageOriginHiddenUserDto extends DataTransferObject implements MessageOriginInterface
{
    public string $type;
    public int    $date;
    public string $sender_user_name;
}