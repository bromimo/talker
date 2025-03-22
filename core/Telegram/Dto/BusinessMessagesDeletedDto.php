<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class BusinessMessagesDeletedDto extends DataTransferObject
{
    public string  $business_connection_id;
    public ChatDto $chat;
    /** @var int[] */
    public array $message_ids;
}