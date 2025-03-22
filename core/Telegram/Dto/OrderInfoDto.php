<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class OrderInfoDto extends DataTransferObject
{
    public ?string $name;
    public ?string $phone_number;
    public ?string $email;

    public ?ShippingAddressDto $shipping_address;
}