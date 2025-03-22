<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VideoDto extends DataTransferObject
{
    public string        $file_id;
    public string        $file_unique_id;
    public int           $width;
    public int           $height;
    public int           $duration;
    public ?PhotoSizeDto $thumbnail;
    /** @var PhotoSizeDto[] */
    public ?array  $cover;
    public ?int    $start_timestamp;
    public ?string $file_name;
    public ?string $mime_type;
    public ?int    $file_size;
}