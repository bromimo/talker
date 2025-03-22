<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChatBoostUpdatedDto extends DataTransferObject
{
    public ChatDto      $chat;
    public ChatBoostDto $boost;
}