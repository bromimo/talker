<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class LinkPreviewOptionsDto extends DataTransferObject
{
    public ?bool   $is_disabled;
    public ?string $url;
    public ?bool   $prefer_small_media;
    public ?bool   $prefer_large_media;
    public ?bool   $show_above_text;
}