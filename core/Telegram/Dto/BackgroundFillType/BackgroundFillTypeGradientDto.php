<?php

namespace core\Telegram\Dto\BackgroundFillType;

use Spatie\DataTransferObject\DataTransferObject;

final class BackgroundFillTypeGradientDto extends DataTransferObject implements BackgroundFillTypeInterface
{
    public string $type;
    public int    $top_color;
    public int    $bottom_color;
    public int    $rotation_angle;
}