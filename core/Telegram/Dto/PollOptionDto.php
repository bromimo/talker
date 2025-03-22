<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PollOptionDto extends DataTransferObject
{
    public string $text;
    public int    $voter_count;
    /** @var MessageEntityDto[] */
    public ?array $text_entities = null;
}