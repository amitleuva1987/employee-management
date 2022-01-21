<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
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
            'company_name' => $this->faker->name(),
            'company_type' => $this->faker->randomElement(['Public Limited Company','Private Limited Company', 'Registered Company']),
            'website' => "http://".Str::slug($this->faker->name()).".com",
            'company_description' => $this->faker->text()
        ];
    }
}
