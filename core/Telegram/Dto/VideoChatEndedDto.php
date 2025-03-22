<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VideoChatEndedDto extends DataTransferObject
{
    public int $duration;
}