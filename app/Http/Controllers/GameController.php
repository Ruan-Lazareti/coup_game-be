<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Game;
use App\Events\PlayerJoined;

class GameController extends Controller
{
	public function createGame()
	{
		$game = Game::create();
		return response()->json($game->id);
	}

	public function joinGame(Request $request)
	{
		$sessionId = $request->session()->getId();
		$name = $request->input('name');
		$gameId = $request->input('game_id');
		$player = Player::create([
			'name' => $name,
			'game_id' => $gameId,
			'session_id' => $sessionId
		]);

		broadcast(new PlayerJoined($player))->toOthers();

		return response()->json($player);

		/*
		Implementação de deixar a lista de players nos dados da sessão
		Mas estava dando problema porque cada player tem sua própria sessão

		$players = $request->session()->get('players', []);
		$players[] = $player;
		$request->session()->put('players', $players);
		*/
	}

	public function getPlayers(Request $request) {
		$gameId = $request->query('game_id');
		$players = Player::where('game_id', $gameId)->get();

		return response()->json($players);
	}
}