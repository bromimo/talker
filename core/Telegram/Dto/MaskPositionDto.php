<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class MaskPositionDto extends DataTransferObject
{
    public string $point;
    public float  $x_shift;
    public float  $y_shift;
    public float  $scale;
}