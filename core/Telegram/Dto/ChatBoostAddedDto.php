<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChatBoostAddedDto extends DataTransferObject
{
    public int $boost_count;
}