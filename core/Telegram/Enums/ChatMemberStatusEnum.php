<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum ChatMemberStatusEnum: string
{
    use EnumToArray;

    case Creator = 'creator';
    case Administrator = 'administrator';
    case Member = 'member';
    case Restricted = 'restricted';
    case Left = 'left';
    case Kicked = 'kicked';

    public function label(): string
    {
        return match ($this) {
            self::Creator => 'Creator',
            self::Administrator => 'Administrator',
            self::Member => 'Member',
            self::Restricted => 'Restricted',
            self::Left => 'Left',
            self::Kicked => 'Kicked',
        };
    }
}
