<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class WebAppInfoDto extends DataTransferObject
{
    public string $url;
}