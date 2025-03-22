<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class StoryDto extends DataTransferObject
{
    public ChatDto $chat;
    public int     $id;
}