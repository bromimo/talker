<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PollAnswerDto extends DataTransferObject
{
    public string  $poll_id;
    public ChatDto $voter_chat;
    public UserDto $user;
    /** @var int[] */
    public array $option_ids;
}