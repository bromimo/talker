<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class WebAppDataDto extends DataTransferObject
{
    public string $data;
    public string $button_text;
}