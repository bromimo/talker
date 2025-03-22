<?php

namespace core\Telegram\Dto\PaidMedia;

use core\Telegram\Dto\VideoDto;
use Spatie\DataTransferObject\DataTransferObject;

final class PaidMediaVideoDto extends DataTransferObject implements PaidMediaInterface
{
    public string   $type;
    public VideoDto $video;
}