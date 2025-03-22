<?php

namespace core\Telegram\Enums;

use App\Traits\Enums\EnumToArray;

enum ParseModeEnum: string
{
    use EnumToArray;

    case MarkdownV2 = 'MarkdownV2';
    case HTML = 'HTML';
    case Markdown = 'Markdown';

    public function label(): string
    {
        return match ($this) {
            self::MarkdownV2 => 'MarkdownV2',
            self::HTML => 'HTML',
            self::Markdown => 'Markdown',
        };
    }
}
