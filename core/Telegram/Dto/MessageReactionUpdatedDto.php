<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use core\Telegram\Dto\ReactionType\ReactionTypeCaster;
use core\Telegram\Dto\ReactionType\ReactionTypeInterface;

final class MessageReactionUpdatedDto extends DataTransferObject
{
    public ChatDto $chat;
    public int     $message_id;
    public int     $date;

    /** @var ReactionTypeInterface[] */
    #[CastWith(ArrayCaster::class, ReactionTypeCaster::class)]
    public array $old_reaction;

    /** @var ReactionTypeInterface[] */
    #[CastWith(ArrayCaster::class, ReactionTypeCaster::class)]
    public array $new_reaction;

    public ?UserDto $user       = null;
    public ?ChatDto $actor_chat = null;
}