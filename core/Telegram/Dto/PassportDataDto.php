<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PassportDataDto extends DataTransferObject
{
    /** @var EncryptedPassportElementDto[] */
    public array                   $data;
    public EncryptedCredentialsDto $credentials;
}