<?php

use core\Talker\Route;
use core\Talker\Controllers\GetController;
use core\Talker\Controllers\MapController;
use core\Talker\Controllers\HelpController;
use core\Talker\Controllers\StartController;
use core\Talker\Controllers\RecordController;
use core\Talker\Controllers\ServiceController;
use core\Talker\Controllers\CallAdminController;

Route::command('start', StartController::class);

Route::command('get', function () {
    Route::param('me', [GetController::class, 'me']);
    Route::param('bot', [GetController::class, 'bot']);
});

Route::phrase('запись', function () {
    Route::phrase('моя', [RecordController::class, 'my'])->alias(['мои','последняя']);
    Route::phrase('отменить', [RecordController::class, 'delete'])->alias(['удалить']);
});

Route::action('record', [RecordController::class, 'my']);
Route::action('help', HelpController::class);
Route::action('call_admin', CallAdminController::class);
Route::action('map', MapController::class);
Route::action('services', ServiceController::class);
