<?php

namespace core\Telegram\Dto\BackgroundType;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\BackgroundFillType\BackgroundFillCaster;
use core\Telegram\Dto\BackgroundFillType\BackgroundFillTypeInterface;

final class BackgroundTypeFillDto extends DataTransferObject implements BackgroundTypeInterface
{
    public string $type;
    public int    $dark_theme_dimming;

    #[CastWith(BackgroundFillCaster::class)]
    public BackgroundFillTypeInterface $fill;
}