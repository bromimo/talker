<?php

namespace core\Telegram\Dto\ChatMember;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;

final class ChatMemberOwnerDto extends DataTransferObject implements ChatMemberInterface
{
    public string  $status;
    public UserDto $user;
    public bool    $is_anonymous;
    public ?string $custom_title;
}