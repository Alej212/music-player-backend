<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Sample;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Crear un usuario
        $user = User::factory(50)->create();

        // Crear una playlist por defecto
        Playlist::create([
            'user_id' => 1,
            'name' => 'default',
            'image_path' => 'default.jpg'
        ]);

        // Crear playlists adicionales
        $playlists = Playlist::factory(50)->create();

        // Crear samples adicionales
        $samples = Sample::factory(100)->create();

        // Asociar samples a playlists
        $playlists->each(function ($playlist) use ($samples) {
            $playlist->samples()->attach(
                $samples->random(rand(1, 10))->pluck('id')->toArray()
            );
        });
    }
}
