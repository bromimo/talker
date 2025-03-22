<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class SwitchInlineQueryChosenChatDto extends DataTransferObject
{
    public ?string $query;
    public ?bool   $allow_user_chats;
    public ?bool   $allow_bot_chats;
    public ?bool   $allow_group_chats;
    public ?bool   $allow_channel_chats;
}