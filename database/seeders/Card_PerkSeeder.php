<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Card_PerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('card_perk')->insert([
            ['card_id' => 1, 'perk_id' => 1],
            ['card_id' => 2, 'perk_id' => 3],
            ['card_id' => 2, 'perk_id' => 4],
            ['card_id' => 3, 'perk_id' => 2],
            ['card_id' => 4, 'perk_id' => 5],
            ['card_id' => 4, 'perk_id' => 9],
            ['card_id' => 5, 'perk_id' => 6],
            ['card_id' => 5, 'perk_id' => 4],
            ['card_id' => 6, 'perk_id' => 7],
            ['card_id' => 6, 'perk_id' => 8],
            ['card_id' => 6, 'perk_id' => 4]
        ]);
    }
}
