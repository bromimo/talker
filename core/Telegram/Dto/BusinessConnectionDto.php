<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class BusinessConnectionDto extends DataTransferObject
{
    public string  $id;
    public UserDto $user;
    public int     $user_chat_id;
    public int     $date;
    public bool    $can_reply;
    public bool    $is_enabled;
}