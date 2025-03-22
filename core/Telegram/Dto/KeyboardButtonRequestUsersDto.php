<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class KeyboardButtonRequestUsersDto extends DataTransferObject
{
    public int   $request_id;
    public ?bool $user_is_bot;
    public ?bool $user_is_premium;
    public ?int  $max_quantity;
    public ?bool $request_name;
    public ?bool $request_username;
    public ?bool $request_photo;
}