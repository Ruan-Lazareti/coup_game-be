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
        Route::post('/game', [GameController::class, 'createGame']);
        Route::get('/game/{gameId}', [GameController::class, 'getGame']);
        Route::put('/game/{gameId}', [GameController::class, 'updateGameState']);
        Route::delete('/game/{gameId}', [GameController::class, 'deleteGame']);

        Route::post('/game/join/{gameId}', [GameController::class, 'joinGame']);
	});

	//Rotas de funcionalidade do jogo
	Route::group(['middleware' => ['web']], function () {
		Route::get('/game/income', [GameController::class, 'income']);
	});
