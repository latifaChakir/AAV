<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voiture>
 */
class VoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marque' => $this->faker->word,
            'modele' => $this->faker->word,
            'annee' => $this->faker->year,
            'kilometrage' => $this->faker->numberBetween(0, 200000),
            'prix' => $this->faker->randomFloat(2, 1000, 100000),
            'puissance' => $this->faker->numberBetween(50, 500),
            'motorisation' => $this->faker->word,
            'carburant' => $this->faker->randomElement(['Essence', 'Diesel', 'Hybride', 'Électrique']),
            'options' => $this->faker->paragraph,

        ];
    }
}
