<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VideoNoteDto extends DataTransferObject
{
    public string        $file_id;
    public string        $file_unique_id;
    public int           $length;
    public int           $duration;
    public ?PhotoSizeDto $thumbnail;
    public ?int          $file_size;
}