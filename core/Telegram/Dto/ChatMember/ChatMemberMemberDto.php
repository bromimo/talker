<?php

namespace core\Telegram\Dto\ChatMember;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;

final class ChatMemberMemberDto extends DataTransferObject implements ChatMemberInterface
{
    public string  $status;
    public UserDto $user;
    public ?int    $until_date;
}