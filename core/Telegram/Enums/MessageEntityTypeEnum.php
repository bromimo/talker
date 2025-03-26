<?php

namespace core\Telegram\Enums;

enum MessageEntityTypeEnum: string
{
    case Mention = 'mention';
    case Hashtag = 'hashtag';
    case Cashtag = 'cashtag';
    case BotCommand = 'bot_command';
    case Url = 'url';
    case Email = 'email';
    case PhoneNumber = 'phone_number';
    case Bold = 'bold';
    case Italic = 'italic';
    case Underline = 'underline';
    case Strikethrough = 'strikethrough';
    case Spoiler = 'spoiler';
    case Blockquote = 'blockquote';
    case ExpandableBlockquote = 'expandable_blockquote';
    case Code = 'code';
    case Pre = 'pre';
    case TextLink = 'text_link';
    case TextMention = 'text_mention';
    case CustomEmoji = 'custom_emoji';

    public function label(): string
    {
        return match ($this) {
            self::Mention => 'Mention',
            self::Hashtag => 'Hashtag',
            self::Cashtag => 'Cashtag',
            self::BotCommand => 'BotCommand',
            self::Url => 'Url',
            self::Email => 'Email',
            self::PhoneNumber => 'PhoneNumber',
            self::Bold => 'Bold',
            self::Italic => 'Italic',
            self::Underline => 'Underline',
            self::Strikethrough => 'Strikethrough',
            self::Spoiler => 'Spoiler',
            self::Blockquote => 'Blockquote',
            self::ExpandableBlockquote => 'ExpandableBlockquote',
            self::Code => 'Code',
            self::Pre => 'Pre',
            self::TextLink => 'TextLink',
            self::TextMention => 'TextMention',
            self::CustomEmoji => 'CustomEmoji',
        };
    }
}
