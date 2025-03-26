<?php

namespace core\Talker\Dto;

use core\Talker\Enums\RouteMethodEnum;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Casters\EnumCaster;
use Spatie\DataTransferObject\Attributes\CastWith;

final class RouteDto extends DataTransferObject
{
    #[CastWith(EnumCaster::class, RouteMethodEnum::class)]
    public RouteMethodEnum $method;
    public string $name;
    /** @var RouteDto[]|array|string|null  */
    public array|string|null $action;
    public ?array $alias;
}