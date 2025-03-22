<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PhotoSizeDto extends DataTransferObject
{
    public string $file_id;
    public string $file_unique_id;
    public int    $width;
    public int    $height;
    public ?int   $file_size;
}