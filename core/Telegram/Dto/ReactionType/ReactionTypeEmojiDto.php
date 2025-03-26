<?php

namespace core\Telegram\Dto\ReactionType;

use core\Telegram\Enums\ReactionEmojiEnum;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Spatie\DataTransferObject\Attributes\CastWith;

final class ReactionTypeEmojiDto extends DataTransferObject implements ReactionTypeInterface
{
    public string $type;

    #[CastWith(EnumCaster::class, ReactionEmojiEnum::class)]
    public ReactionEmojiEnum $emoji;
}