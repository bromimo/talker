<?php

use core\Telegram\Telegram;

require_once "requires.php";

$url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$url = str_replace("/install.php", "/tg.php", $url);

try {
    echo Telegram::setWebhook($url);
} catch (Exception $e) {
    echo $e->getMessage();
}
