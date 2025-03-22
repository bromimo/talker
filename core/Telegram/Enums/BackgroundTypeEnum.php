<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum BackgroundTypeEnum: string
{
    use EnumToArray;

    case Fill = 'fill';
    case Wallpaper = 'wallpaper';
    case Pattern = 'pattern';
    case ChatTheme = 'chat_theme';

    public function label(): string
    {
        return match ($this) {
            self::Fill => 'Fill',
            self::Wallpaper => 'Wallpaper',
            self::Pattern => 'Pattern',
            self::ChatTheme => 'ChatTheme',
        };
    }
}
