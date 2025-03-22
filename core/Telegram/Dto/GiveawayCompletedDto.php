<?php

namespace core\Telegram\Dto;

use core\Telegram\Dto\MaybeInaccessibleMessage\MessageDto;
use Spatie\DataTransferObject\DataTransferObject;

final class GiveawayCompletedDto extends DataTransferObject
{
    public int         $winner_count;
    public ?int        $unclaimed_prize_count;
    public ?MessageDto $giveaway_message;
    public ?bool       $is_star_giveaway;
}