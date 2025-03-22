<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ForumTopicCreatedDto extends DataTransferObject
{
    public string  $name;
    public int     $icon_color;
    public ?string $icon_custom_emoji_id;
}