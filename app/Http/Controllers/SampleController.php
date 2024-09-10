<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Sample;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    //* Get all samples of one playlist
    public function obtainAllSamplesFromOnePlaylist($playlistId) {
        $playlist = Playlist::find($playlistId);
        if ($playlist) {
            $samples = $playlist->samples;
            return $samples;
            // return response()->json(['message' => "All samples has been find successfully"], 200);
        }
    }
    //* Delete all samples of one playlist
    public function deleteAllSamplesFromOnePlaylist($playlistId) {
        $playlist = Playlist::find($playlistId);
        if ($playlist) {
            $samples = $playlist->samples;
            foreach ($samples as $sample) {
                $sample->delete();
            }
            return response()->json(['message' => "All playlist has been deleted successfully"], 200);
        } else {
            return response()->json(['message' => "playlist cannot be found"], 404);
        }
    }
    //* Get one sample of one playlist
    public function obtainOneSampleFromOnePlaylist($sample_id, $playlist_id) {
        $playlist = Playlist::find($playlist_id);
        if ($playlist) {
            $sample = $playlist->samples()->find($sample_id);
            if ($sample) {
                return response()->json($sample, 200);
            } else {
                return response()->json(['message' => 'Sample not found in this playlist'], 404);
            }
        } else {
            return response()->json(['message' => 'Playlist not found.'], 404);
        }
    }
    //* Delete one sample of one playlist
    public function deleteOneSampleFromOnePlaylist($sample_id, $playlist_id) {
        $playlist = Playlist::find($playlist_id);
        if ($playlist) {
            $sample = $playlist->samples()->find($sample_id);
            if ($sample) {
                $sample->delete();
                return response()->json($sample, 200);
            } else {
                return response()->json(['message' => "the sample cannot be deleted because the sample cannot be found in this playlist {$playlist_id}"], 404);
            }
        } else {
            return response()->json(['message' => 'Playlist not found.'], 404);
        }
    }
    //* Update one sample of one playlist
    public function updateOneSampleFromOnePlaylist($playlistId, $sampleId, $newName, $newDescription, $newPath) {
        $playlist = Playlist::find($playlistId);
        if ($playlist) {
            $newSample = $playlist->samples()->find($sampleId);
            if ($newSample) {
                $newSample->name = $newName;
                $newSample->description = $newDescription;
                $newSample->sample_path = $newPath;
                $newSample->save();
                return response()->json($newSample, 200);
            } else {
                return response()->json(['message' => 'Sample cannot be changed'], 404);
            }
        } else {
            return response()->json(['message' => 'Playlist not found.'], 404);
        }
    }
    //* Get all samples
    public function obtainAllSamples() {
        $samples = Sample::all();
        return $samples;
    }
    //* Create one sample
    public function createOneSample(Request $request) {
        $validateData = $request->validate([
            'playlist_id' => 'required|exists:playlist_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sample_path' => 'required|string|max:255',
        ]);
        // create sample
        $sample = Sample::create($validateData);
        return response()->json(['message'=>'Sample created successfully.', 'sample' => $sample], 201);
    }
}
