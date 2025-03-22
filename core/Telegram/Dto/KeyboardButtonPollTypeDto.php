<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class KeyboardButtonPollTypeDto extends DataTransferObject
{
    public ?string $type;
}