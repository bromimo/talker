<?php

namespace core\Telegram\Dto\BackgroundType;

use core\Telegram\Dto\DocumentDto;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\BackgroundFillType\BackgroundFillCaster;
use core\Telegram\Dto\BackgroundFillType\BackgroundFillTypeInterface;

final class BackgroundTypePatternDto extends DataTransferObject implements BackgroundTypeInterface
{
    public string      $type;
    public DocumentDto $document;
    public int         $intensity;
    public ?bool       $is_inverted;
    public ?bool       $is_moving;

    #[CastWith(BackgroundFillCaster::class)]
    public BackgroundFillTypeInterface $fill;
}