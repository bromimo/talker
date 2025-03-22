<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class UsersSharedDto extends DataTransferObject
{
    public int $request_id;
    /** @var UserDto[] */
    public array $users;
}