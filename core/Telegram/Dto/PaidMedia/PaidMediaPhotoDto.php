<?php

namespace core\Telegram\Dto\PaidMedia;

use core\Telegram\Dto\PhotoSizeDto;
use Spatie\DataTransferObject\DataTransferObject;

final class PaidMediaPhotoDto extends DataTransferObject implements PaidMediaInterface
{
    public string $type;
    /** @var PhotoSizeDto[] */
    public array $photo;
}