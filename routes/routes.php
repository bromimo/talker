<?php

use core\Talker\Route;
use core\Talker\Controllers\GetController;
use core\Talker\Controllers\MapController;
use core\Talker\Controllers\BotController;
use core\Talker\Controllers\HelpController;
use core\Talker\Controllers\PaycardController;
use core\Talker\Controllers\StartController;
use core\Talker\Controllers\DoingController;
use core\Talker\Controllers\PriceController;
use core\Talker\Controllers\RecordController;
use core\Telegram\Enums\ChatMemberStatusEnum;
use core\Talker\Controllers\ServiceController;
use core\Talker\Controllers\WorkTimeController;
use core\Talker\Controllers\GreetingController;
use core\Talker\Controllers\CallAdminController;
use core\Talker\Controllers\BotStatusController;
use core\Talker\Controllers\MemberStatusController;
use core\Talker\Controllers\SterilizationController;

Route::botStatus(ChatMemberStatusEnum::Member, [BotStatusController::class, 'member']);

Route::memberStatus(ChatMemberStatusEnum::Member, [MemberStatusController::class, 'member']);
Route::memberStatus(ChatMemberStatusEnum::Left, [MemberStatusController::class, 'left']);

Route::command('start', StartController::class);

Route::command('get', function () {
    Route::param('me', [GetController::class, 'me']);
    Route::param('bot', [GetController::class, 'bot']);
});

Route::phrase('запись', function () {
    Route::phrase('моя', [RecordController::class, 'my'])->alias(['мои', 'последняя']);
    Route::phrase('отменить', [RecordController::class, 'delete'])->alias(['удалить']);
});

Route::phrase('делаете', function () {
    Route::phrase('ногти', DoingController::class)
         ->alias(['аппаратный','апаратный','френч','фрэнч','ногтях','кислотный']);
})->alias(['рисуете', 'наращиваете']);

Route::phrase('найти', MapController::class)
    ->alias(['находитесь','находится','добраться','доехать','попасть','искать','проехать']);

Route::phrase('цен', function () {
    Route::phrase('маникюр', [PriceController::class, 'manicure'])->alias(['гель','лак','ногт','ногот']);
    Route::phrase('педикюр', [PriceController::class, 'pedicure']);
    Route::phrase('ресниц', [PriceController::class, 'lash'])->alias(['реснич']);
    Route::phrase('', PriceController::class);
})->alias(['прайс','стоит','стоят','стоимость']);

Route::phrase('карта', PaycardController::class)->alias(['карточка', 'картой', 'безнал', 'карту']);
Route::phrase('стерилиз', SterilizationController::class)
    ->alias(['дезинфекция','дезинфицируете','обработка','обрабатываете','сухожар']);

Route::phrase('график работы', WorkTimeController::class)->alias(['как работает','вы работает']);
Route::phrase('привет', GreetingController::class)
    ->alias(['здраст','здравст','хай','хелло','трям','добрый','доброе']);

Route::preg('/^б[о]+т/ui', BotController::class);

Route::action('paycard', PaycardController::class);
Route::action('record', [RecordController::class, 'my']);
Route::action('add_record', [RecordController::class, 'add']);
Route::action('delete_record', [RecordController::class, 'delete']);
Route::action('help', HelpController::class);
Route::action('call_admin', CallAdminController::class);
Route::action('map', MapController::class);
Route::action('services', ServiceController::class);
