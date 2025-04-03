<?php

namespace core\Talker\Enums;

enum MessageTypeEnum: string
{
    case Message = 'message';
    case EditedMessage = 'edited_message';
    case ChannelPost = 'channel_post';
    case EditedChannelPost = 'edited_channel_post';
    case BusinessMessage = 'business_message';
    case EditedBusinessMessage = 'edited_business_message';
    case CallbackQuery = 'callback_query';

    public function label(): string
    {
        return match ($this) {
            self::Message => 'Message',
            self::EditedMessage => 'EditedMessage',
            self::ChannelPost => 'ChannelPost',
            self::EditedChannelPost => 'EditedChannelPost',
            self::BusinessMessage => 'BusinessMessage',
            self::EditedBusinessMessage => 'EditedBusinessMessage',
            self::CallbackQuery => 'CallbackQuery',
        };
    }
}
