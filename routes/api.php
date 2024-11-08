<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PerkController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;

	Route::resource('/cards', CardController::class);
  Route::get('/perks', [PerkController::class, 'index']);

	//Rotas pra iniciar o jogo
	Route::group(['middleware' => ['web']], function () {
		Route::post('/game/create', [GameController::class, 'createGame']);
		Route::get('/game/players', [GameController::class, 'getPlayers']);
		Route::post('/game/join', [GameController::class, 'joinGame']);
		Route::post('/game/start', [GameController::class, 'startGame']);
		Route::get('/game/player-cards', [GameController::class, 'getPlayerCards']);
	});

	//Rotas de funcionalidade do jogo
	Route::group(['middleware' => ['web']], function () {
		Route::get('/game/income', [GameController::class, 'income']);
	});