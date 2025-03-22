<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ShippingQueryDto extends DataTransferObject
{
    public string             $id;
    public UserDto            $from;
    public string             $invoice_payload;
    public ShippingAddressDto $shipping_address;
}