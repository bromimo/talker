<?php

namespace core\Telegram\Dto\MessageOrigin;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\MessageOriginTypeEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class MessageOriginCaster implements Caster
{
    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $data): MessageOriginInterface
    {
        if (!is_array($data) || !isset($data['type'])) {
            throw new Exception("Invalid type of message data");
        }

        return match ($data['type']) {
            MessageOriginTypeEnum::User => new MessageOriginUserDto($data),
            MessageOriginTypeEnum::HiddenUser => new MessageOriginHiddenUserDto($data),
            MessageOriginTypeEnum::Chat => new MessageOriginChatDto($data),
            MessageOriginTypeEnum::Channel => new MessageOriginChannelDto($data),
            default => throw new Exception("Unknown type of message: {$data['type']}"),
        };
    }
}