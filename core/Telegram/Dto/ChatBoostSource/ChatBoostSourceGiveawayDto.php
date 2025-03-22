<?php

namespace core\Telegram\Dto\ChatBoostSource;

use core\Telegram\Dto\UserDto;
use Spatie\DataTransferObject\DataTransferObject;

final class ChatBoostSourceGiveawayDto extends DataTransferObject implements ChatBoostSourceInterface
{
    public string   $source;
    public int      $giveaway_message_id;
    public ?UserDto $user;
    public ?int     $prize_star_count;
    public ?bool    $is_unclaimed;
}