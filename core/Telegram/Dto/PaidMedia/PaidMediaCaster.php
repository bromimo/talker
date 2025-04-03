<?php

namespace core\Telegram\Dto\PaidMedia;

use Exception;
use Spatie\DataTransferObject\Caster;
use core\Telegram\Enums\PaidMediaTypeEnum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class PaidMediaCaster implements Caster
{
    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $data): PaidMediaInterface
    {
        if (!is_array($data) || !isset($data['type'])) {
            throw new Exception("Invalid type of paid media data");
        }

        return match (PaidMediaTypeEnum::tryFrom($data['type'])) {
            PaidMediaTypeEnum::Preview => new PaidMediaPreviewDto($data),
            PaidMediaTypeEnum::Photo => new PaidMediaPhotoDto($data),
            PaidMediaTypeEnum::Video => new PaidMediaVideoDto($data),
            default => throw new Exception("Unknown type of paid media: {$data['type']}"),
        };
    }
}