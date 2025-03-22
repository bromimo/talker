<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\ChatBoostSource\ChatBoostSourceCaster;
use core\Telegram\Dto\ChatBoostSource\ChatBoostSourceInterface;

final class ChatBoostRemovedDto extends DataTransferObject
{
    public ChatDto $chat;
    public string  $boost_id;
    public int     $remove_date;

    #[CastWith(ChatBoostSourceCaster::class)]
    public ChatBoostSourceInterface $source;
}