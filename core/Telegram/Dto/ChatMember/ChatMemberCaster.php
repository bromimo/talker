<?php

namespace core\Telegram\Dto\ChatMember;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\ChatMemberStatusEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class ChatMemberCaster implements Caster
{
    /**
     * @throws UnknownProperties
     */
    public function cast(mixed $data): ChatMemberInterface
    {
        if (!is_array($data) || !isset($data['status'])) {
            throw new Exception("Invalid chat member status data");
        }

        return match (ChatMemberStatusEnum::tryFrom($data['status'])) {
            ChatMemberStatusEnum::Creator => new ChatMemberOwnerDto($data),
            ChatMemberStatusEnum::Administrator => new ChatMemberAdministratorDto($data),
            ChatMemberStatusEnum::Member => new ChatMemberMemberDto($data),
            ChatMemberStatusEnum::Restricted => new ChatMemberRestrictedDto($data),
            ChatMemberStatusEnum::Left => new ChatMemberLeftDto($data),
            ChatMemberStatusEnum::Kicked => new ChatMemberBannedDto($data),
            default => throw new Exception("Unknown chat member status: {$data['status']}"),
        };
    }
}