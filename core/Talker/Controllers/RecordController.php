<?php

namespace core\Talker\Controllers;

use core\Journal\Journal;
use core\Telegram\Telegram;
use core\Telegram\Components\Button;
use core\Telegram\Components\Message;
use core\Telegram\Components\Keyboard;
use core\Talker\Controllers\Abstracts\Controller;

class RecordController extends Controller
{
    public function my(): void
    {
        $records = Journal::getUserNextRecords('+380958496291');

        if (empty($records)) {
            $message = 'у вас пока что нет записей.';
            $keyboard = Keyboard::make()->buttons([
                [Button::make('📝   Записаться на процедуру')->action('add_record')],
                [Button::make('🆕   Узнать места')->action('map')],
            ]);

        } else {
            $message = $this->formRecordsString($records);
            $keyboard = Keyboard::make()->buttons([
                [Button::make('📝   Записаться на процедуру')->action('add_record')],
                [Button::make('🚫   Отменить запись')->action('delete_record')],
                [Button::make('🆕   Узнать места')->action('map')],
            ]);
        }

        Telegram::sendMessage(
            Message::make("📖 *{$this->getName()}*, {$message}")->keyboard($keyboard)
        );
    }

    public function delete(): void
    {
        Telegram::sendMessage(
            Message::make('Вы хотите удалить запись')
        );
    }

    private function formRecordsString(array $records): string
    {
        $recordStrings = array_map(function ($row) {
            return "📌 {$row['record']} " . substr($row['time'], 0, 5) . " {$row['data']} {$row['firstName']} {$row['lastName']}";
        }, $records);

        return 'вы записаны на: ' . "\n" . implode("\n", $recordStrings);
    }
}