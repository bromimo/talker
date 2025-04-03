<?php

namespace core\Talker\Controllers;

use core\Telegram\Telegram;
use core\Telegram\Components\Photo;
use core\Talker\Controllers\Abstracts\Controller;

class PriceController extends Controller
{
    public function __invoke(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendPhoto(
            Photo::make(asset('img/priceManicure.jpg'))
        );
        Telegram::sendPhoto(
            Photo::make(asset('img/pricePedicure.jpg'))
        );
    }

    public function manicure(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendPhoto(
            Photo::make(asset('img/priceManicure.jpg'))
        );
    }

    public function pedicure(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendPhoto(
            Photo::make(asset('img/pricePedicure.jpg'))
        );
    }

    public function lash(): void
    {
        Telegram::deletePreviousMessage();
        Telegram::sendPhoto(
            Photo::make(asset('img/priceLash.jpg'))
        );
    }
}