<?php

namespace core\Telegram\Dto\MaybeInaccessibleMessage;

use Exception;
use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class MaybeInnaccessibleMessageCaster implements Caster
{
    /**
     * @throws UnknownProperties
     */
    public function cast(mixed $data): MaybeInaccessibleMessageInterface
    {
        if (!is_array($data) || !isset($data['date'])) {
            throw new Exception("Invalid message data");
        }

        if ($data['date'] === 0) {
            return new InaccessibleMessageDto($data);
        }

        return new MessageDto($data);
    }
}