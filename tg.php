<?php
require_once "requires.php";

use core\Telegram\Telegram;

Telegram::getInstance()->handleWebhook();
