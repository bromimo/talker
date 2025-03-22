<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VoiceDto extends DataTransferObject
{
    public string  $file_id;
    public string  $file_unique_id;
    public int     $duration;
    public ?string $mime_type;
    public ?int    $file_size;
}