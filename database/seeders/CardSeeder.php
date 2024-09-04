<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cards')->insert([
            ['id' => 1, 'image' => 'images/vY6GAnCazwo5kMObRPwCPIDmQ4iXzfghX2M5aQgd.png', 'name' => 'Assassino'],
            ['id' => 2, 'image' => 'images/UCoS0JJ24yGntQIqftU8t6p6YddDJYlOElYWnEKI.png', 'name' => 'Capitão'],
            ['id' => 3, 'image' => 'images/uY8mUxZTcFfBNVJYVnwLk2lXj4U21PiEUkxBNFYH.png', 'name' => 'Condessa'],
            ['id' => 4, 'image' => 'images/orJTwxloj1wi1mAmvTmtiX3BiylAFMfhs0Wdyb9N.png', 'name' => 'Duque'],
            ['id' => 5, 'image' => 'images/pZjwzcvRA6B42ZtrHX7BFcwEe1mXxD9MHYdzVjvb.png', 'name' => 'Embaixador'],
            ['id' => 6, 'image' => 'images/sEFeykkF5JEas4YnOh9oQI752y3WI0wAHOlTlaon.png', 'name' => 'Inquisidor']
        ]);
    }
}
