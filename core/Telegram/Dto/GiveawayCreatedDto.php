<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class GiveawayCreatedDto extends DataTransferObject
{
    public ?int $prize_star_count;
}