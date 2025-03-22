<?php

namespace core\Telegram\Dto;

use core\Telegram\Dto\PaidMedia\PaidMediaCaster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use core\Telegram\Dto\PaidMedia\PaidMediaInterface;

final class PaidMediaInfoDto extends DataTransferObject
{
    public int $star_count;

    /** @var PaidMediaInterface[] */
    #[CastWith(ArrayCaster::class, PaidMediaCaster::class)]
    public array $paid_media;
}