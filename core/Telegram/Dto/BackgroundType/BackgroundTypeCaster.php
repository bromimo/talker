<?php

namespace core\Telegram\Dto\BackgroundType;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\BackgroundTypeEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class BackgroundTypeCaster implements Caster
{
    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $data): BackgroundTypeInterface
    {
        if (!is_array($data) || !isset($data['type'])) {
            throw new Exception("Invalid background type data");
        }

        return match (BackgroundTypeEnum::tryFrom($data['type'])) {
            BackgroundTypeEnum::Fill => new BackgroundTypeFillDto($data),
            BackgroundTypeEnum::Wallpaper => new BackgroundTypeWallpaperDto($data),
            BackgroundTypeEnum::Pattern => new BackgroundTypePatternDto($data),
            BackgroundTypeEnum::ChatTheme => new BackgroundTypeChatThemeDto($data),
            default => throw new Exception("Unknown background type: {$data['type']}"),
        };
    }
}