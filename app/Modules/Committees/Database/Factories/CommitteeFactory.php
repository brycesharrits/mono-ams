<?php

namespace App\Modules\Committees\Database\Factories;

use App\Modules\Committees\Models\Committee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Committee>
 */
class CommitteeFactory extends Factory
{
    protected $model = Committee::class;

    public function definition(): array
    {
        return [
            'name' => ucwords($this->faker->unique()->words(2, true)).' Committee',
            'description' => $this->faker->optional()->sentence(12),
        ];
    }
}
