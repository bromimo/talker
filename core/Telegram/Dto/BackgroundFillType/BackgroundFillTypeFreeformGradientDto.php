<?php

namespace core\Telegram\Dto\BackgroundFillType;

use Spatie\DataTransferObject\DataTransferObject;

final class BackgroundFillTypeFreeformGradientDto extends DataTransferObject implements BackgroundFillTypeInterface
{
    public string $type;
    /** @var int[] */
    public array $colors;
}