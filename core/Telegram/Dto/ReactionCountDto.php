<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\ReactionType\ReactionTypeCaster;
use core\Telegram\Dto\ReactionType\ReactionTypeInterface;

final class ReactionCountDto extends DataTransferObject
{
    #[CastWith(ReactionTypeCaster::class)]
    public ReactionTypeInterface $type;

    public int $total_count;
}