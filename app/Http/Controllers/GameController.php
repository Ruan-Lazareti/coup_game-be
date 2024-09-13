<?php

namespace App\Http\Controllers;

use App\Events\GameStarted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Broadcast;

use App\Models\Game;
use App\Models\Card;
use App\Models\Player;
use App\Models\PlayerCard;

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

	public function startGame(Request $request)
	{
		$gameId = $request->input('game_id');

		$this->dealCards($gameId);

		broadcast(new GameStarted($gameId))->toOthers();

		return response()->json(['message' => $gameId]);
	}

	public function dealCards($gameId)
	{
		$players = Player::where('game_id', $gameId)->get();
		$availableCards = Card::all();

		foreach ($players as $player) {
			$playerCards = [];
			for($i = 0; $i < 2; $i++) {
				$randomCard = $availableCards->random();
				$playerCards[] = $randomCard;

				PlayerCard::create([
					'player_id' => $player->id,
					'card_id' => $randomCard->id,
					'game_id' => $gameId,
				]);
			}
		}
	}

	public function getPlayerCards(Request $request)
	{
		$sessionId = $request->query('session_id');
		$gameId = $request->query('game_id');

		$player  = Player::where('session_id', $sessionId)
										 ->where('game_id', $gameId)
										 ->first();

		if($player) {
			$cards = PlayerCard::where('player_id', $player->id)
				                 ->with('card')
												 ->get()
												 ->pluck('card');

			return response()->json($cards);
		} else {
			return response()->json([], 404);
		}
	}

}