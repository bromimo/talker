<?php

namespace core\Telegram\Dto\PaidMedia;

use Spatie\DataTransferObject\DataTransferObject;

final class PaidMediaPreviewDto extends DataTransferObject implements PaidMediaInterface
{
    public string $type;
    public ?int   $width;
    public ?int   $height;
    public ?int   $duration;
}