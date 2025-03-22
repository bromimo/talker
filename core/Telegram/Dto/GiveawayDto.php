<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class GiveawayDto extends DataTransferObject
{
    /** @var ChatDto[] */
    public array   $chats;
    public int     $winners_selection_date;
    public int     $winner_count;
    public ?bool   $only_new_members;
    public ?bool   $has_public_winners;
    public ?string $prize_description;
    /** @var string[] */
    public ?array $country_codes;
    public ?int   $prize_star_count;
    public ?int   $premium_subscription_month_count;
}