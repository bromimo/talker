<?php

namespace core\Telegram\Dto\ReactionType;

use Spatie\DataTransferObject\DataTransferObject;

final class ReactionTypePaidDto extends DataTransferObject implements ReactionTypeInterface
{
    public string $type;
}