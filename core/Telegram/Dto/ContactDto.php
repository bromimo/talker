<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ContactDto extends DataTransferObject
{
    public string  $phone_number;
    public string  $first_name;
    public ?string $last_name;
    public ?int    $user_id;
    public ?string $vcard;
}