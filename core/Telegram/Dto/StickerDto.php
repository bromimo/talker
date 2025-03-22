<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class StickerDto extends DataTransferObject
{
    public string           $file_id;
    public string           $file_unique_id;
    public string           $type;
    public int              $width;
    public int              $height;
    public bool             $is_animated;
    public bool             $is_video;
    public ?PhotoSizeDto    $thumbnail;
    public ?string          $emoji;
    public ?string          $set_name;
    public ?FileDto         $premium_animation;
    public ?MaskPositionDto $mask_position;
    public ?string          $custom_emoji_id;
    public ?bool            $needs_repainting;
    public ?int             $file_size;
}