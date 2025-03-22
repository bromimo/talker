<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ShippingAddressDto extends DataTransferObject
{
    public string $country_code;
    public string $state;
    public string $city;
    public string $street_line1;
    public string $street_line2;
    public string $post_code;
}