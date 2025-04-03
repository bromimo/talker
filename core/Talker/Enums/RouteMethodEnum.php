<?php

namespace core\Talker\Enums;

enum RouteMethodEnum: string
{
    case Command = 'command';
    case Phrase = 'phrase';
    case Param = 'param';
    case Action = 'action';
    case BotStatus = 'bot_status';
    case MemberStatus = 'member_status';
    case Preg = 'preg';

    public function label(): string
    {
        return match ($this) {
            self::Command => 'Command',
            self::Phrase => 'Phrase',
            self::Param => 'Param',
            self::Action => 'Action',
            self::BotStatus => 'BotStatus',
            self::MemberStatus => 'MemberStatus',
            self::Preg => 'Preg',
        };
    }
}
