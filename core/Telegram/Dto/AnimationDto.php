<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class AnimationDto extends DataTransferObject
{
    public string        $file_id;
    public string        $file_unique_id;
    public int           $width;
    public int           $height;
    public int           $duration;
    public ?PhotoSizeDto $thumbnail;
    public ?string       $file_name;
    public ?string       $mime_type;
    public ?int          $file_size;
}