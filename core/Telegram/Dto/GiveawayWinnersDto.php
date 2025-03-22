<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class GiveawayWinnersDto extends DataTransferObject
{
    public ChatDto $chat;
    public int     $giveaway_message_id;
    public int     $winners_selection_date;
    public int     $winner_count;
    /** @var UserDto[] */
    public array   $winners;
    public ?int    $additional_chat_count;
    public ?int    $prize_star_count;
    public ?int    $premium_subscription_month_count;
    public ?int    $unclaimed_prize_count;
    public ?bool   $only_new_members;
    public ?bool   $was_refunded;
    public ?string $prize_description;
}