<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'movie_id' => \App\Models\Movie::all()->random()->id,
        'auditorium_id' => \App\Models\Auditorium::all()->random()->id,
        'starts_at' => $this->faker->dateTimeBetween('now', '+1 week'),
        'ticket_price' => 40000,
    ];
    }
}
