<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class LoginUrlDto extends DataTransferObject
{
    public string  $url;
    public ?string $forward_text;
    public ?string $bot_username;
    public ?bool   $request_write_access;
}