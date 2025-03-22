<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class TextQuoteDto extends DataTransferObject
{
    public string $text;
    public int    $position;
    /** @var MessageEntityDto[] */
    public ?array $entities;
    public ?bool  $is_manual;
}