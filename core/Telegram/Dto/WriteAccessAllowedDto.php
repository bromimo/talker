<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class WriteAccessAllowedDto extends DataTransferObject
{
    public ?bool   $from_request;
    public ?string $web_app_name;
    public ?bool   $from_attachment_menu;
}