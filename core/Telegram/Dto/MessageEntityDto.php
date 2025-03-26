<?php

namespace core\Telegram\Dto;

use core\Telegram\Enums\MessageEntityTypeEnum;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Spatie\DataTransferObject\Attributes\CastWith;

final class MessageEntityDto extends DataTransferObject
{
    #[CastWith(EnumCaster::class, MessageEntityTypeEnum::class)]
    public MessageEntityTypeEnum $type;

    public int      $offset;
    public int      $length;
    public ?string  $url;
    public ?UserDto $user;
    public ?string  $language;
    public ?string  $custom_emoji_id;
}