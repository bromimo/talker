<?php

namespace core\Telegram\Dto\ChatBoostSource;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\ChatBootSourceEnum;

final class ChatBoostSourceCaster implements Caster
{
    /**
     * @throws Exception
     */
    public function cast(mixed $data): ChatBoostSourceInterface
    {
        if (!is_array($data) || !isset($data['source'])) {
            throw new Exception("Invalid chat boost source data");
        }

        return match (ChatBootSourceEnum::tryFrom($data['source'])) {
            ChatBootSourceEnum::Premium => new ChatBoostSourcePremiumDto(),
            ChatBootSourceEnum::GiftCode => new ChatBoostSourceGiftCodeDto(),
            ChatBootSourceEnum::Giveaway => new ChatBoostSourceGiveawayDto(),
            default => throw new Exception("Unknown chat boost source: {$data['source']}"),
        };
    }
}