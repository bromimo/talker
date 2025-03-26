<?php

namespace core\Telegram\Enums;

enum BackgroundFillTypeEnum: string
{
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
