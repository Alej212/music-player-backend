<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Playlist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sample>
 */
class SampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener todos los paths de los archivos MP3
        $mp3Directory = public_path('sounds');
        $mp3Files = array_diff(scandir($mp3Directory), array('..', '.'));

        // Obtener todos los IDs de las playlists
        $playlistIds = Playlist::pluck('id')->toArray();

        return [
            'name' => fake()->sentence(3),
            'description' => fake()->text(255),
            'sample_path' => $this->faker->randomElement($mp3Files)
        ];
    }
}
