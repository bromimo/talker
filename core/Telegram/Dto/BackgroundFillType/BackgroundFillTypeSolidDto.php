<?php

namespace core\Telegram\Dto\BackgroundFillType;

use Spatie\DataTransferObject\DataTransferObject;

final class BackgroundFillTypeSolidDto extends DataTransferObject implements BackgroundFillTypeInterface
{
    public string $type;
    public int    $color;
}