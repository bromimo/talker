<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class RefundedPaymentDto extends DataTransferObject
{
    public string  $currency;
    public int     $total_amount;
    public string  $invoice_payload;
    public string  $telegram_payment_charge_id;
    public ?string $provider_payment_charge_id;
}