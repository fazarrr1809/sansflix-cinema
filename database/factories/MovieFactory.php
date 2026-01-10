<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => $this->faker->sentence(3),
        'genre' => $this->faker->randomElement(['Action', 'Horror', 'Sci-Fi', 'Comedy', 'Drama']),
        'description' => $this->faker->paragraph(),
        'duration_minutes' => $this->faker->numberBetween(90, 180),
        'release_date' => $this->faker->date(),
        // Gunakan URL poster asli dari TMDB
        'poster_url' => $this->faker->randomElement([
            'https://image.tmdb.org/t/p/w500/8cdcl3oRj4t9BqGzX8W9p9of7m8.jpg',
            'https://image.tmdb.org/t/p/w500/7WsyChvnavS0p0vwsXvE5o6uRSr.jpg',
            'https://image.tmdb.org/t/p/w500/hu40UxpSr7A0fXIvOs40TTVvbsu.jpg',
            'https://image.tmdb.org/t/p/w500/dB6S7C6p8pve9vS696Yv3pY9SIn.jpg'
        ]),
        'rating' => $this->faker->randomFloat(1, 5, 9.9),
        'age_rating' => $this->faker->randomElement(['SU', '13+', '17+', '21+']),
        'status' => 'now_playing',
        'trailer_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    ];
}
}
