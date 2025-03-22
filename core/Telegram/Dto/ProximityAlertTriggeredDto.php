<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class ProximityAlertTriggeredDto extends DataTransferObject
{
    public UserDto $traveler;
    public UserDto $watcher;
    public int     $distance;
}