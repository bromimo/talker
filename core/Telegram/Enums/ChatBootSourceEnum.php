<?php

namespace core\Telegram\Enums;

enum ChatBootSourceEnum: string
{
    case Premium = 'premium';
    case GiftCode = 'gift_code';
    case Giveaway = 'giveaway';

    public function label(): string
    {
        return match ($this) {
            self::Premium => 'Premium',
            self::GiftCode => 'GiftCode',
            self::Giveaway => 'Giveaway',
        };
    }
}
