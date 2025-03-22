<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class EncryptedPassportElementDto extends DataTransferObject
{
    public string  $type;
    public string  $hash;
    public ?string $data;
    public ?string $phone_number;
    public ?string $email;
    /** @var PassportFileDto[] */
    public ?array           $files;
    public ?PassportFileDto $front_side;
    public ?PassportFileDto $reverse_side;
    public ?PassportFileDto $selfie;
    /** @var PassportFileDto[] */
    public ?array $translation;
}