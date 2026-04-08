<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Em desenvolvimento... Aguarde... 🤖'
    ]);
});