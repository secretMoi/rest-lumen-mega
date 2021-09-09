<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->name,
            'mail' => $this->faker->unique()->safeEmail,
            'password' => app("hash")->make('123456'),
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
        ];
    }
}
