<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChatDto extends DataTransferObject
{
    public int     $id;
    public string  $type;
    public ?string $title;
    public ?string $username;
    public ?string $first_name;
    public ?string $last_name;
    public ?bool   $is_forum;
}