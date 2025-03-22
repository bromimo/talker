<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VideoChatScheduledDto extends DataTransferObject
{
    public int $start_date;
}