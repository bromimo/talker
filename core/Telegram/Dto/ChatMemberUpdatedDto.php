<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\ChatMember\ChatMemberCaster;
use core\Telegram\Dto\ChatMember\ChatMemberInterface;

final class ChatMemberUpdatedDto extends DataTransferObject
{
    public ChatDto            $chat;
    public UserDto            $from;
    public int                $date;
    #[CastWith(ChatMemberCaster::class)]
    public ChatMemberInterface      $old_chat_member;
    #[CastWith(ChatMemberCaster::class)]
    public ChatMemberInterface      $new_chat_member;
    public ?ChatInviteLinkDto $invite_link;
    public ?bool              $via_join_request;
    public ?bool              $via_chat_folder_invite_link;
}