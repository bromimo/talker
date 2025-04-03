<?php

namespace core\Telegram\Dto\BackgroundFillType;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\BackgroundFillTypeEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class BackgroundFillCaster implements Caster
{
    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $data): BackgroundFillTypeInterface
    {
        if (!is_array($data) || !isset($data['type'])) {
            throw new Exception("Invalid background fill data");
        }

        return match (BackgroundFillTypeEnum::tryFrom($data['type'])) {
            BackgroundFillTypeEnum::Solid => new BackgroundFillTypeSolidDto($data),
            BackgroundFillTypeEnum::Gradient => new BackgroundFillTypeGradientDto($data),
            BackgroundFillTypeEnum::FreeformGradient => new BackgroundFillTypeFreeformGradientDto($data),
            default => throw new Exception("Unknown background fill type: " . $data['type']),
        };
    }
}