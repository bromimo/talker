<?php

namespace core\Talker\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class CommandDto extends DataTransferObject
{
    public string  $name;
    public ?string $param;
}