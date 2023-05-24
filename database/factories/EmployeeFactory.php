<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'designation' => $this->faker->jobTitle,
            'email' => $this->faker->email,
            'department' => $this->faker->catchPhrase
        ];
    }
}
