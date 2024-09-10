<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PerkController;
use App\Http\Controllers\CardController;

	Route::resource('/cards', CardController::class);

  Route::get('/perks', [PerkController::class, 'index']);
