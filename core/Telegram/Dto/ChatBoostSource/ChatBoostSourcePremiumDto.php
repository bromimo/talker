<?php

namespace core\Telegram\Dto\ChatBoostSource;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;

final class ChatBoostSourcePremiumDto extends DataTransferObject implements ChatBoostSourceInterface
{
    public string  $source;
    public UserDto $user;
}