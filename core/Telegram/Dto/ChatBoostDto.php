<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\ChatBoostSource\ChatBoostSourceCaster;
use core\Telegram\Dto\ChatBoostSource\ChatBoostSourceInterface;

final class ChatBoostDto extends DataTransferObject
{
    public string $boost_id;
    public int    $add_date;
    public int    $expiration_date;

    #[CastWith(ChatBoostSourceCaster::class)]
    public ChatBoostSourceInterface $source;
}