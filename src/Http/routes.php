<?php

use OsKoala\Statistics\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::get('statistics', Controllers\StatisticsController::class . '@index');
});
