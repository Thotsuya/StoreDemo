<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'street' => $this->faker->streetAddress(),
            'district' => $this->faker->city(),
            'city' => $this->faker->city()
        ];
    }
}
