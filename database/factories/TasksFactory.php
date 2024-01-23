<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::all()->random()->id,
            "title" => $this->faker->sentence(),
            "category" => $this->faker->sentence(),
            "deadline" => $this->faker->dateTimeBetween('now', '+1 year'),
            "description" => $this->faker->text(),
            "is_successful" => $this->faker->randomElement([true, false]),
            "status" => $this->faker->randomElement(["active", "inactive"]),
            "priority" => $this->faker->randomElement(["top","medium","low"]),

        ];
    }
}
