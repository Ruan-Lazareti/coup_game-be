<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class GameService
{
    private const GAME_PREFIX = 'game:'; // Prefixo para chaves do Redis

    public function createGame($gameId, $nickname)
    {
        // Armazena o jogo no Redis com uma expiração de 1 hora
        Redis::hmset(self::GAME_PREFIX . $gameId, [
            'current_player' => null,
            'players' => json_encode([$nickname]),
            'status' => 'waiting',
        ]);
        Redis::expire(self::GAME_PREFIX . $gameId, 3600);

        return [
            'game_id' => $gameId,
        ];
    }

    public function getGame($gameId)
    {
        $gameData = Redis::hgetall(self::GAME_PREFIX . $gameId);

        if (empty($gameData)) {
            return null;
        }

        // Decodifica os jogadores
        $gameData['players'] = json_decode($gameData['players'], true);

        return $gameData;
    }

    public function joinGame($gameId, $nickname)
    {
        $gameKey = self::GAME_PREFIX . $gameId;

        if(!Redis::exists($gameKey)) {
            return ['error' => 'Jogo não encontrado'];
        }

        $gameData = Redis::hgetall($gameKey);
        $players = json_decode($gameData['players'], true) ?? [];

        if (in_array($nickname, $players)) {
            return ['error' => 'Jogador já está no jogo'];
        }

        $players[] = $nickname;

        Redis::hmset($gameKey, ['players' => json_encode($players)]);

        return ['message' => 'Jogador Conectado'];
    }

    public function updateGameState($gameId, $state)
    {
        Redis::hset(self::GAME_PREFIX . $gameId, 'state', $state);
    }

    public function deleteGame($gameId)
    {
        Redis::del(self::GAME_PREFIX . $gameId);
    }
}
