<?php

namespace core\Talker\Dto;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

final class MemberStatusDto extends DataTransferObject
{
    public string $status;
    /** @var UserDto[]|null */
    #[CastWith(ArrayCaster::class, UserDto::class)]
    public ?array  $new_chat_members;
    public UserDto $left_chat_member;
}