<?php

namespace Database\Factories;

use App\Http\Controllers\ClientController;
use App\Models\Contrat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratFactory extends Factory
{
    protected $model = Contrat::class;

    public function definition(): array
    {
        $gsrnPart1 = $this->faker->randomNumber(7, true);
        $gsrnPart2 = $this->faker->randomNumber(7, true);

        return [
            'client_id' => (int) (new ClientController())->GetOneRandomly()->id,
            'energy' => $this->faker->word(),
            'product' => $this->faker->word(),
            'gsrn' => $gsrnPart1 . $gsrnPart2,
            'duration' => $this->faker->numberBetween(1, 72),
            'codePromo' => $this->faker->word()
        ];
    }
}
