<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class MessageEntityDto extends DataTransferObject
{
    public string   $type;
    public int      $offset;
    public int      $length;
    public ?string  $url;
    public ?UserDto $user;
    public ?string  $language;
    public ?string  $custom_emoji_id;
}