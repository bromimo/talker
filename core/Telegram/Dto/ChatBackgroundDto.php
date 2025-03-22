<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\BackgroundType\BackgroundTypeCaster;
use core\Telegram\Dto\BackgroundFillType\BackgroundFillTypeInterface;

final class ChatBackgroundDto extends DataTransferObject
{
    #[CastWith(BackgroundTypeCaster::class)]
    public BackgroundFillTypeInterface $type;
}