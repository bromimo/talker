<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class MessageAutoDeleteTimerChangedDto extends DataTransferObject
{
    public int $message_auto_delete_time;
}