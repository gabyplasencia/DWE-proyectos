<?php

use App\Http\Controllers\BlackjackController;
use Illuminate\Support\Facades\Route;


Route::any('/', [BlackjackController::class, 'index']);
Route::any('/blackjack/mostrarmazo', [BlackjackController::class, 'mostrarMazo']);
Route::any('/blackjack/sacarcarta', [BlackjackController::class, 'sacarCarta']);
Route::any('/blackjack/meplanto', [BlackjackController::class, 'mePlanto']);
Route::any('/blackjack/partidanueva', [BlackjackController::class, 'partidaNueva']);
