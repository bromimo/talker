<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ForumTopicEditedDto extends DataTransferObject
{
    public ?string $name;
    public ?string $icon_custom_emoji_id;
}