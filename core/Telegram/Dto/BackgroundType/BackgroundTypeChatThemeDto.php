<?php

namespace core\Telegram\Dto\BackgroundType;

use Spatie\DataTransferObject\DataTransferObject;

final class BackgroundTypeChatThemeDto extends DataTransferObject implements BackgroundTypeInterface
{
    public string $type;
    public string $theme_name;
}