<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class KeyboardButtonRequestChatDto extends DataTransferObject
{
    public int   $request_id;
    public bool   $chat_is_channel;
    public ?bool $chat_is_forum;
    public ?bool $chat_has_username;
    public ?bool $chat_is_created;
    public ?ChatAdministratorRightsDto $user_administrator_rights;
    public ?ChatAdministratorRightsDto $bot_administrator_rights;
    public ?bool $bot_is_member;
    public ?bool $request_title;
    public ?bool $request_username;
    public ?bool $request_photo;
}