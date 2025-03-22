<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ForceReplyDto extends DataTransferObject
{
    public bool    $force_reply;
    public ?string $input_field_placeholder;
    public ?bool   $selective;
}