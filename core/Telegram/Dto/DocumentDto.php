<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class DocumentDto extends DataTransferObject
{
    public string        $file_id;
    public string        $file_unique_id;
    public ?PhotoSizeDto $thumbnail;
    public ?string       $file_name;
    public ?string       $mime_type;
    public ?int          $file_size;
}