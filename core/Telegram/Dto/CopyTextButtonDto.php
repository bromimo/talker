<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class CopyTextButtonDto extends DataTransferObject
{
    public string $text;
}