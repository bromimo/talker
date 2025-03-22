<?php

namespace core\Telegram\Dto\BackgroundType;

use core\Telegram\Dto\DocumentDto;
use Spatie\DataTransferObject\DataTransferObject;

final class BackgroundTypeWallpaperDto extends DataTransferObject implements BackgroundTypeInterface
{
    public string      $type;
    public DocumentDto $document;
    public int         $dark_theme_dimming;
    public ?bool       $is_blurred;
    public ?bool       $is_moving;
}