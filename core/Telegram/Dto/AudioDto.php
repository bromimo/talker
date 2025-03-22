<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class AudioDto extends DataTransferObject
{
    public string        $file_id;
    public string        $file_unique_id;
    public int           $duration;
    public ?string       $performer;
    public ?string       $title;
    public ?string       $file_name;
    public ?string       $mime_type;
    public ?int          $file_size;
    public ?PhotoSizeDto $thumbnail;
}