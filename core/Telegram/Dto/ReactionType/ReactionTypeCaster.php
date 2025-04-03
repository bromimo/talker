<?php

namespace core\Telegram\Dto\ReactionType;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\ReactionTypeEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class ReactionTypeCaster implements Caster
{
    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $data): ReactionTypeInterface
    {
        if (!is_array($data) || !isset($data['type'])) {
            throw new Exception("Invalid type of reaction data");
        }

        return match ($data['type']) {
            ReactionTypeEnum::Emoji => new ReactionTypeEmojiDto($data),
            ReactionTypeEnum::CustomEmoji => new ReactionTypeCustomEmojiDto($data),
            ReactionTypeEnum::Paid => new ReactionTypePaidDto($data),
            default => throw new Exception("Unknown type of reaction: {$data['type']}"),
        };
    }
}