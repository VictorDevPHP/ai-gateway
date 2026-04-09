<?php

use App\Http\Controllers\Api\NameClassificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'agents'], function () {

        Route::group(['prefix' => 'classify-name'], function () {
            Route::post('/', [NameClassificationController::class, 'classifyName'])->name('agents.classify-name.classify-name');
            Route::get('/identify-name', [NameClassificationController::class, 'identifyName'])->name('agents.classify-name.identify-name');
        });
    });
});