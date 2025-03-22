<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class DiceDto extends DataTransferObject
{
    public string $emoji;
    public int    $value;
}