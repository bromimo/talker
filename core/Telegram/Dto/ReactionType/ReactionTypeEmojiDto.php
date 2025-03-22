<?php

namespace core\Telegram\Dto\ReactionType;

use core\Telegram\Enums\ReactionEmojiEnum;
use Spatie\DataTransferObject\DataTransferObject;

final class ReactionTypeEmojiDto extends DataTransferObject implements ReactionTypeInterface
{
    public string            $type;
    public ReactionEmojiEnum $emoji;
}