<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [

            'lead_code' => 'LEAD-' . fake()->unique()->numberBetween(1000, 9999),

            'lead_name' => fake()->name(),

            'company_name' => fake()->company(),

            'email' => fake()->unique()->safeEmail(),

            'phone' => fake()->numerify('##########'),

            'source' => fake()->randomElement([
                'Website',
                'Facebook',
                'Instagram',
                'Google',
                'Referral',
                'WhatsApp',
                'LinkedIn',
                'Cold Call'
            ]),

            'status' => fake()->randomElement([
                'New',
                'Contacted',
                'Qualified',
                'Proposal',
                'Won',
                'Lost'
            ]),

            'expected_value' => fake()->randomFloat(2, 1000, 1000000),

            'follow_up_date' => fake()->dateTimeBetween('today', '+30 days'),

            'notes' => fake()->paragraph(),

            'created_by' => User::factory(),
        ];
    }
}