<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum ReactionTypeEnum: string
{
    use EnumToArray;

    case Emoji = 'emoji';
    case CustomEmoji = 'custom_emoji';
    case Paid = 'paid';

    public function label(): string
    {
        return match ($this) {
            self::Emoji => 'Emoji',
            self::CustomEmoji => 'CustomEmoji',
            self::Paid => 'Paid',
        };
    }
}
