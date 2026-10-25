<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_number' => 'M-'.$this->faker->unique()->numerify('######'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'pending', 'expired']),
            'joined_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
