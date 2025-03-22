<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChosenInlineResultDto extends DataTransferObject
{
    public string       $result_id;
    public UserDto      $from;
    public string       $query;
    public ?LocationDto $location;
    public ?string      $inline_message_id;
}