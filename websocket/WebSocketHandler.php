<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class WebSocketHandler
{
    public function onPlayerJoin($gameId, $nickname)
    {
        // Aqui você pode conectar o jogador à sala
        $client = new Client(new Version2X('http://localhost:3000'));

        try {
            $client->initialize();

            // Enviar dados ao servidor sobre o jogador
            $client->emit('player_join', [
                'game_id' => $gameId,
                'nickname' => $nickname
            ]);

            $client->close();
            echo "Jogador '$nickname' entrou no jogo $gameId.\n";
        } catch (\Exception $e) {
            echo "Erro ao tentar conectar ao servidor: " . $e->getMessage();
        }
    }

    public function onPlayerLeave($gameId, $nickname)
    {
        // Lógica para quando um jogador sai da sala
        $client = new Client(new Version2X('http://localhost:3000'));

        try {
            $client->initialize();

            // Emitir evento para remover o jogador
            $client->emit('player_leave', [
                'game_id' => $gameId,
                'nickname' => $nickname
            ]);

            $client->close();
            echo "Jogador '$nickname' saiu do jogo $gameId.\n";
        } catch (\Exception $e) {
            echo "Erro ao tentar conectar ao servidor: " . $e->getMessage();
        }
    }
}
