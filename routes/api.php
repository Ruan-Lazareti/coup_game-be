<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PerkController;
use App\Http\Controllers\CardController;


  Route::get('/cards', [CardController::class, 'index']);
  Route::get('/cards/{id}', [CardController::class, 'show']);
  Route::post('/cards', [CardController::class, 'store']);
  Route::put('/cards/{id}', [CardController::class, 'update']);
  Route::delete('/cards/{id}', [CardController::class, 'destroy']);

  Route::get('/perks', [PerkController::class, 'index']);
