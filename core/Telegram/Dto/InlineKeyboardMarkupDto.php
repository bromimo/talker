<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class InlineKeyboardMarkupDto extends DataTransferObject
{
    /** @var InlineKeyboardButtonDto[][] */
    public array $inline_keyboard;
}