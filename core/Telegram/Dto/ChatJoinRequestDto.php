<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChatJoinRequestDto extends DataTransferObject
{
    public ChatDto $chat;
    public UserDto $from;
    public int     $user_chat_id;
    public int     $date;
    public ?string $bio;

    public ?ChatInviteLinkDto $invite_link;
}