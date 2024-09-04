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
            'perk' => 'kill'
        ]);
        DB::table('perks')->insert([
            'perk' => 'killCancel'
        ]);
        DB::table('perks')->insert([
            'perk' => 'extort'
        ]);
        DB::table('perks')->insert([
            'perk' => 'extortCancel'
        ]);
        DB::table('perks')->insert([
            'perk' => 'threeGold'
        ]);
        DB::table('perks')->insert([
            'perk' => 'buyTwoCard'
        ]);
        DB::table('perks')->insert([
            'perk' => 'buyOneCard'
        ]);
        DB::table('perks')->insert([
            'perk' => 'cardExchange'
        ]);
        DB::table('perks')->insert([
            'perk' => 'cancelTwoGold'
        ]);
    }
}
