<?php

namespace Database\Factories;

use App\Models\Contrat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratFactory extends Factory
{
    protected $model = Contrat::class;

    public function definition(): array
    {
        return [
            'client_id ' => $this->faker->randomNumber(0, 1000),
            'energy' => $this->faker->word,
            'product' => $this->faker->word,
            'gsrn' => $this->faker->randomNumber(14),
            'duration' => $this->faker->numberBetween(1, 72),
            'codePromo' => $this->faker->word
        ];
    }
}
