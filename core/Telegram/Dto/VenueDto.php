<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class VenueDto extends DataTransferObject
{
    public LocationDto $location;
    public string      $title;
    public string      $address;
    public ?string     $foursquare_id;
    public ?string     $foursquare_type;
    public ?string     $google_place_id;
    public ?string     $google_place_type;
}