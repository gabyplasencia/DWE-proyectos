<?php

use App\Http\Controllers\BlackjackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blackjack');
});

Route::any('/blackjack/mostrarmazo', [BlackjackController::class, 'mostrarMazo']);
