<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [

            'customer_code' => 'CUST'.fake()->unique()->numberBetween(1000,9999),

            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'phone' => fake()->phoneNumber(),

            'company_name' => fake()->company(),

            'city' => fake()->city(),

            'state' => fake()->state(),

            'country' => 'India',

            'status' => 'Active',

        ];
    }
}