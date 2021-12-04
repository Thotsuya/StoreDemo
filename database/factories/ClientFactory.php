<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_number' => $this->faker->randomNumber(8),
            'name' => $this->faker->name(),
            'credit_limit' => rand(1000,100000)
        ];
    }
}
