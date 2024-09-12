<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PerkController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;

	Route::resource('/cards', CardController::class);
  Route::get('/perks', [PerkController::class, 'index']);

	Route::group(['middleware' => ['web']], function () {
		Route::post('/game/create', [GameController::class, 'createGame']);
		Route::post('/game/join', [GameController::class, 'joinGame']);
		Route::get('/game/players', [GameController::class, 'getPlayers']);
	});
