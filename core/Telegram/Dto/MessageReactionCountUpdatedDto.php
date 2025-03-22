<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class MessageReactionCountUpdatedDto extends DataTransferObject
{
    public ChatDto $chat;
    public int     $message_id;
    public int     $date;
    /** @var ReactionCountDto[] */
    public array $reactions;
}