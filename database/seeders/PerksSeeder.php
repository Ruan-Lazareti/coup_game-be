<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perks')->insert([
            ['perk' => 'kill', 'description' => 'Assassine a influência de um jogador pagando 3 moedas. Caso ele seja contestado pelo jogador que sofreu a ação e estiver falando a verdade (realmente tenha o Assassino), o jogador que sofreu o assassinato perde as duas cartas'],
            ['perk' => 'killCancel', 'description' => 'Bloqueia o Assassino'],
            ['perk' => 'extort', 'description' => 'Extorque outro jogador, pegando duas moedas dele'],
            ['perk' => 'extortCancel', 'description' => 'Bloqueia a extorsão de outro jogador'],
            ['perk' => 'threeGold', 'description' => 'Colete 3 moedas do banco'],
            ['perk' => 'buyTwoCard', 'description' => 'Pegue duas cartas do baralho e em seguida devolva duas. Pode escolher livremente quais cartas irá ficar na mão e quais cartas irá devolver ao monte'],
            ['perk' => 'buyOneCard', 'description' => 'Pegue uma carta do baralho e em seguida devolva uma. Pode escolher livremente quais cartas irá ficar na na mão e qual carta irá devolver ao monte'],
            ['perk' => 'cardExchange', 'description' => 'Olhe uma carta de outro jogador, e, em seguida, pode apenas devolvê-la para o adversário ou trocar com uma de suas cartas'],
            ['perk' => 'cancelTwoGold', 'description' => 'Bloqueia ajuda externa (Pegar 2 moedas do banco)'],
        ]);
    }
}
