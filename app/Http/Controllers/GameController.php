<?php

namespace App\Http\Controllers;

use App\Events\GameStarted;
use App\Events\TurnChanged;
use Illuminate\Http\Request;

use App\Models\Game;
use App\Models\Card;
use App\Models\Player;
use App\Models\PlayerCard;

use App\Events\PlayerJoined;
use App\Events\PlayerUpdated;

class GameController extends Controller
{
	//Funções pra iniciar o jogo
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
	}

	public function getPlayers(Request $request) {
		$gameId = $request->query('game_id');
		$players = Player::where('game_id', $gameId)->get();

		return response()->json($players);
	}

	public function startGame(Request $request)
	{
		$gameId = $request->input('game_id');
		$game = Game::find($gameId);
		$randomPlayer = Player::where('game_id', $gameId)->inRandomOrder()->first();

		$game->current_player_id = $randomPlayer->id;
		$game->save();

		$this->dealCards($gameId);

		broadcast(new GameStarted($gameId))->toOthers();
		broadcast(new TurnChanged($randomPlayer))->toOthers();

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


	//Funcionalidades do jogo

	public function updatePlayers($game) {
		$players = Player::where('game_id', $game->id)->get();

		broadcast(new PlayerUpdated($players))->toOthers();

		return response()->json($players);
	}
	public function nextTurn($player, $game)
	{
		$nextPlayer = Player::where('game_id', $game->id)
			->where('id', '>', $player->id)
			->orderBy('id')
			->first();

		if($nextPlayer) {
			$game->current_player_id = $nextPlayer->id;
			$game->save();

			broadcast(new TurnChanged($nextPlayer))->toOthers();

			return response()->json([], 200);
		} else {
			$nextPlayer = Player::where('game_id', $game->id)
				->orderBy('id')
				->first();

			$game->current_player_id = $nextPlayer->id;
			$game->save();

			broadcast(new TurnChanged($nextPlayer))->toOthers();

			return response()->json([], 200);
		}
	}

	public function income(Request $request)
	{
		$sessionId = $request->query('session_id');
		$gameId = $request->query('game_id');

		$player = Player::where('session_id', $sessionId)
			->where('game_id', $gameId)
			->first();
		$game = Game::find($gameId);

		if ($player && $game && $game->current_player_id == $player->id) {
			$player->coins += 1;
			$player->save();

			$this->nextTurn($player, $game);

			broadcast(new PlayerUpdated($player))->toOthers();

			return response()->json($player);
		} else {
			return response()->json([], 404);
		}
	}

}