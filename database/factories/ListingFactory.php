<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle,
            'tags' => 'Laravel,JavaScript,Api',
            'company' => fake()->company,    
            'location' => 'Colombo, SL',
            'email' => fake()->companyEmail,
            'website' => fake()->url,
            'description' => fake()->paragraph(5),
        ];
    }
}
