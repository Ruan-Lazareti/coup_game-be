<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->word(),
            'name' => $this->faker->name(),
            'perks' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
