<?php

use core\Telegram\Telegram;

require_once "requires.php";

$actual_link = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$actual_link = str_replace("/install.php", "", $actual_link);

Telegram::make(env("TG_BOT_API_KEY"))->getMe()->dd();