<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    // $user = User::factory()
    // ->has(Post::factory()->count(3))
    // ->create();

    // User::factory()
    //         ->hasPosts(3)
    //         ->create();

    public function definition()
    {
        return [
            //'company_id' => '',
            'first_name' => $this->faker->firstname(),
            'last_name' => $this->faker->lastname(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->name(),
            'city' => $this->faker->randomElement(['surat', 'ahmedabad', 'baroda', 'mehsana', 'palanpur']),
            'country' => 'India',
            'status' => 'Active',
        ];
    }
}
