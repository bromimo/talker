<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class KeyboardButtonDto extends DataTransferObject
{
    public string                         $text;
    public ?KeyboardButtonRequestUsersDto $request_users;
    public ?KeyboardButtonRequestChatDto  $request_chat;
    public ?bool                          $request_contact;
    public ?bool                          $request_location;
    public ?KeyboardButtonPollTypeDto     $request_poll;
    public ?WebAppInfoDto                 $web_app;
}