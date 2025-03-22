<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VideoChatParticipantsInvitedDto extends DataTransferObject
{
    /** @var UserDto[] */
    public array $users;
}