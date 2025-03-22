<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ChatSharedDto extends DataTransferObject
{
    public int     $request_id;
    public int     $chat_id;
    public ?string $title;
    public ?string $username;
    /** @var PhotoSizeDto[] */
    public ?array $photo;
}