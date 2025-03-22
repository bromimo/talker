<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PassportFileDto extends DataTransferObject
{
    public string $file_id;
    public string $file_unique_id;
    public int    $file_size;
    public int    $file_date;
}