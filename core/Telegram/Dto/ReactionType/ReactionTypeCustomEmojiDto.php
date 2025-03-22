<?php

namespace core\Telegram\Dto\ReactionType;

use Spatie\DataTransferObject\DataTransferObject;

final class ReactionTypeCustomEmojiDto extends DataTransferObject implements ReactionTypeInterface
{
    public string $type;
    public string $custom_emoji_id;
}