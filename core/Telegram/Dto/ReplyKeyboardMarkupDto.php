<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

final class ReplyKeyboardMarkupDto extends DataTransferObject
{
    /** @var KeyboardButtonDto[][] */
    #[CastWith(ArrayCaster::class, KeyboardButtonDto::class)]
    public array   $keyboard;
    public ?bool   $is_persistent;
    public ?bool   $resize_keyboard;
    public ?bool   $one_time_keyboard;
    public ?string $input_field_placeholder;
    public ?bool   $selective;
}