<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class GameDto extends DataTransferObject
{
    public string $title;
    public string $description;
    /** @var PhotoSizeDto[] */
    public array   $photo;
    public ?string $text;
    /** @var MessageEntityDto[] */
    public ?array        $text_entities;
    public ?AnimationDto $animation;
}