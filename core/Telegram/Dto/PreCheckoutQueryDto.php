<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PreCheckoutQueryDto extends DataTransferObject
{
    public string        $id;
    public UserDto       $from;
    public string        $currency;
    public int           $total_amount;
    public string        $invoice_payload;
    public ?string       $shipping_option_id;
    public ?OrderInfoDto $order_info;
}