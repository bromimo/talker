<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class SuccessfulPaymentDto extends DataTransferObject
{
    public string        $currency;
    public int           $total_amount;
    public string        $invoice_payload;
    public string        $telegram_payment_charge_id;
    public string        $provider_payment_charge_id;
    public ?int          $subscription_expiration_date;
    public ?bool         $is_recurring;
    public ?bool         $is_first_recurring;
    public ?string       $shipping_option_id;
    public ?OrderInfoDto $order_info;
}