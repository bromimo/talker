<?php
require_once "requires.php";

use core\Telegram\Telegram;

$json = '{
  "update_id": 453565858,
  "message": {
    "message_id": 521,
    "from": {
      "id": 962372340,
      "is_bot": false,
      "first_name": "Константин",
      "last_name": "Аржанов",
      "username": "Best_profi_admin",
      "language_code": "ru"
    },
    "chat": {
      "id": 962372340,
      "first_name": "Константин",
      "last_name": "Аржанов",
      "username": "Best_profi_admin",
      "type": "private"
    },
    "date": 1743672638,
    "text": "боооот"
  }
}';

Telegram::getInstance()->mapWebhook($json);
//Telegram::getInstance()->handleWebhook();
