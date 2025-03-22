<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class InvoiceDto extends DataTransferObject
{
    public string $title;
    public string $description;
    public string $start_parameter;
    public string $currency;
    public int    $total_amount;
}