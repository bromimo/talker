<?php

namespace core\Telegram\Dto\MessageOrigin;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;

final class MessageOriginUserDto extends DataTransferObject implements MessageOriginInterface
{
    public string   $type;
    public int      $date;
    public ?UserDto $sender_user = null;
}