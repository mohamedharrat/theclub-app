<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\evenements>
 */
class evenementsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            "title" => $this->faker->word(),
            "description" => $this->faker->paragraph(),
            "publication_date" => now(),
            "author_id" => Arr::random([1, 2, 3, 4]),
        ];
    }
}
