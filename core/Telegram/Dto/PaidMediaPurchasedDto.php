<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PaidMediaPurchasedDto extends DataTransferObject
{
    public UserDto $from;
    public string  $paid_media_payload;
}