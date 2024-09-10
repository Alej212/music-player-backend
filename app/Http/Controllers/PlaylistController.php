<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    //* Obtain all playlists
    public function obtainAllPlaylists() {
        $playlists = Playlist::all();
        return $playlists;
        // return response()->json(['message' => "All playlist has been find successfully"], 200);
    }
    //* Delete all playlist
    public function deleteAllPlaylists() {
        $playlists = Playlist::all();
        foreach($playlists as $playlist) {
            $playlist->delete();
        }
        return response()->json(['message' => "All playlists was deleted"], 200);
    }
    //* Obtain playlist by ID
    public function obtainOnePlaylist($id) {
        $playlist = Playlist::find($id);
        echo $playlist;
        return response()->json(['message' => "playlist has been find"], 200);
    }
    //* Delete playlist by ID
    public function deleteOnePlaylist($id) {
        $playlist = Playlist::find($id);
        $playlist->delete();
        return response()->json(['message' => "{$playlist} playlist has been deleted"], 200);
    }
    //* Update playlist by ID
    public function updateOnePlaylist($id, Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|string|max:255'
        ]);
        $playlist = Playlist::find($id);
        if ($playlist) {
            // Update the playlist attributes
            $playlist->name = $validatedData['name'];
            $playlist->image_path = $validatedData['image_path'] ?? $playlist->image_path;
            $playlist->save();

            return response()->json(['message' => 'Playlist has been updated', 'playlist' => $playlist], 200);
        } else {
            return response()->json(['message' => 'Playlist not found'], 404);
        }
    }
    //* Create one playlist
    public function createOneSample(Request $request) {
        $validateData = $request->validate([
            'user_id' => 'required|exists:user_id',
            'name' => 'required|string|max:255',
            'image_path' => 'required|string|max:255',
        ]);
        // create play list
        $playlist = Playlist::create($validateData);
        return response()->json(['message'=>'playlist created successfully.', 'playlist' => $playlist], 201);
    }
}
