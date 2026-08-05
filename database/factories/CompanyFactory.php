<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [

            'company_code' => 'CMP'.fake()->unique()->numberBetween(1000,9999),

            'company_name' => fake()->company(),

            'contact_person' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'phone' => fake()->phoneNumber(),

            'website' => fake()->url(),

            'gst_number' => strtoupper(fake()->bothify('27AAAAA####A1Z#')),

            'address' => fake()->address(),

            'city' => fake()->city(),

            'state' => fake()->state(),

            'country' => 'India',

            'logo' => null,

            'status' => 'Active'

        ];
    }
}