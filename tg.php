<?php
require_once "requires.php";

use core\Telegram\Telegram;
use core\Telegram\Components\Button;
use core\Telegram\Components\Message;
use core\Telegram\Components\Keyboard;

$json = '{
  "update_id": 453565551,
  "callback_query": {
    "id": "4133357728369910048",
    "from": {
      "id": 962372340,
      "is_bot": false,
      "first_name": "Константин",
      "last_name": "Аржанов",
      "username": "Best_profi_admin",
      "language_code": "ru"
    },
    "message": {
      "message_id": 90,
      "from": {
        "id": 7610274799,
        "is_bot": true,
        "first_name": "test_snack_bot",
        "username": "test_snack_bot"
      },
      "chat": {
        "id": 962372340,
        "first_name": "Константин",
        "last_name": "Аржанов",
        "username": "Best_profi_admin",
        "type": "private"
      },
      "date": 1740991395,
      "text": "Привет!",
      "reply_markup": {
        "inline_keyboard": [
          [
            {
              "text": "Каталог📖",
              "callback_data": "action:catalog"
            },
            {
              "text": "Мы на карте города📍",
              "callback_data": "action:map"
            },
            {
              "text": "Частые Вопросы❓",
              "callback_data": "action:questions"
            },
            {
              "text": "Помощь🆘",
              "callback_data": "action:help"
            }
          ]
        ]
      }
    },
    "chat_instance": "3129054891646081022",
    "data": "action:catalog"
  }
}';

Telegram::getInstance()->mapWebhook($json);
//Telegram::getInstance()->handleWebhook();

//dd(Telegram::getInstance()->webhook->toArray());

$message = Telegram::sendMessage(
    Message::make('Привет!')->keyboard(
        Keyboard::make()->buttons([
            [
                Button::make('Каталог📖')->action('catalog'),
                Button::make('Мы на карте города📍')->action('map'),
                Button::make('Частые Вопросы❓')->action('questions'),
                Button::make('Помощь🆘')->action('help'),
            ],
        ])
    )
);
