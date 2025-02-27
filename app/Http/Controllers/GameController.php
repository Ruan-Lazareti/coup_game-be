<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GameService;

class GameController extends Controller
{
    private GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function createGame(Request $request)
    {
        $gameId = uniqid('game_'); // Gera um ID único para o jogo
        $nickname = $request->input('nickname');

        $gameData = $this->gameService->createGame($gameId, $nickname);

        return response()->json($gameData);
    }

    public function getGame($gameId)
    {
        $game = $this->gameService->getGame($gameId);

        if (!$game) {
            return response()->json(['message' => 'Game not found'], 404);
        }

        return response()->json($game);
    }

    public function updateGameState(Request $request, $gameId)
    {
        $state = $request->input('state');
        $this->gameService->updateGameState($gameId, $state);

        return response()->json(['message' => 'Game state updated']);
    }

    public function joinGame(Request $request, $gameId) {
        $nickname = $request->input('nickname');

        if(!$nickname) {
            return response()->json(['message' => 'Nickname não pode ser vazio'], 400);
        }

        $gameData = $this->gameService->joinGame($gameId, $nickname);

        return response()->json($gameData);
    }

    public function deleteGame($gameId)
    {
        $this->gameService->deleteGame($gameId);

        return response()->json(['message' => 'Game deleted']);
    }
}
