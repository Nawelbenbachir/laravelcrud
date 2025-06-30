<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'tel'=>fake()->optional()->phoneNumber(),
            'adresse'=>fake()->optional()->streetAddress(),
            'ville'=>fake()->optional()->city(),
            'cp'=>fake()->optional()->postcode(),
            ];
    }
}
