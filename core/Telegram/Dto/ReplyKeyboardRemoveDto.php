<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ReplyKeyboardRemoveDto extends DataTransferObject
{
    public bool  $remove_keyboard;
    public ?bool $selective;
}