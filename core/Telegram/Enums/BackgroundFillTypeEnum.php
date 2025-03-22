<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum BackgroundFillTypeEnum: string
{
    use EnumToArray;

    case Solid = 'solid';
    case Gradient = 'gradient';
    case FreeformGradient = 'freeform_gradient';

    public function label(): string
    {
        return match ($this) {
            self::Solid => 'Solid',
            self::Gradient => 'Gradient',
            self::FreeformGradient => 'FreeformGradient',
        };
    }
}
