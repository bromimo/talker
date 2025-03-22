<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class InlineQueryDto extends DataTransferObject
{
    public string       $id;
    public UserDto      $from;
    public string       $query;
    public string       $offset;
    public ?string      $chat_type;
    public ?LocationDto $location;
}