<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum MessageOriginTypeEnum: string
{
    use EnumToArray;

    case User = 'user';
    case HiddenUser = 'hidden_user';
    case Chat = 'chat';
    case Channel = 'channel';

    public function label(): string
    {
        return match ($this) {
            self::User => 'User',
            self::HiddenUser => 'HiddenUser',
            self::Chat => 'Chat',
            self::Channel => 'Channel',
        };
    }
}
