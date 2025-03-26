<?php

namespace core\Telegram\Enums;

enum PaidMediaTypeEnum: string
{
    case Preview = 'preview';
    case Photo = 'photo';
    case Video = 'video';

    public function label(): string
    {
        return match ($this) {
            self::Preview => 'Preview',
            self::Photo => 'Photo',
            self::Video => 'Video',
        };
    }
}
