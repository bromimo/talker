<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class EncryptedCredentialsDto extends DataTransferObject
{
    public string $data;
    public string $hash;
    public string $secret;
}