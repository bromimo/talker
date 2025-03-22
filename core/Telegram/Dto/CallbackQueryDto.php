<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\MaybeInaccessibleMessage\MaybeInnaccessibleMessageCaster;
use core\Telegram\Dto\MaybeInaccessibleMessage\MaybeInaccessibleMessageInterface;

final class CallbackQueryDto extends DataTransferObject
{
    public string  $id;
    public UserDto $from;
    public string  $chat_instance;
    public ?string $inline_message_id;
    public ?string $data;
    public ?string $game_short_name;

    #[CastWith(MaybeInnaccessibleMessageCaster::class)]
    public ?MaybeInaccessibleMessageInterface $message;
}