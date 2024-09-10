<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //* Obtener todos los paths de los archivos MP3
        $imageDirectory = public_path('images');
        $imageFiles = array_diff(scandir($imageDirectory), array('..', '.'));

        $playlistNames = [
            'playlist 1',
            'playlist 2',
            'playlist 3',
            'playlist 4',
            'playlist 5',
            'playlist 6',
            'playlist 7',
            'playlist 8',
            'playlist 9',
            'playlist 10',
        ];

        $usersIds = User::pluck('id')->toArray();
        
        return [
            'user_id' => $this->faker->randomElement($usersIds),
            'name' => $this->faker->randomElement($playlistNames),
            'image_path' => $this->faker->randomElement($imageFiles)
        ];
    }
}
