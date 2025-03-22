<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class FileDto extends DataTransferObject
{
    public string  $file_id;
    public string  $file_unique_id;
    public ?int    $file_size;
    public ?string $file_path;
}