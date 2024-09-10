<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SampleController;


Route::get('/', function () {
    return view('welcome');
});

//* router for users
Route::get('users', [UserController::class, 'obtainAllUsers']);

//* router for playlist
Route::get('playlists', [PlaylistController::class, 'obtainAllPlaylists']);
Route::get('playlists/delete', [PlaylistController::class, 'deleteAllPlaylists']);
Route::get('playlist/{id}', [PlaylistController::class, 'obtainOnePlaylist']);
Route::post('playlist/delete/{id}', [PlaylistController::class, 'deleteOnePlaylist']);
Route::post('playlist/update/{id}', [PlaylistController::class, 'updateOnePlaylist']);
Route::post('playlist/create', [PlaylistController::class, 'createOnePlaylist']);

//* router for samples
Route::get('samples/playlist/{id}', [SampleController::class, 'obtainAllSamplesFromOnePlaylist']);
Route::get('samples/delete/playlist/{id}', [SampleController::class, 'deleteAllSamplesFromOnePlaylist']);
Route::get('samples', [SampleController::class, 'obtainAllSamples']);
Route::post('sample/create', [SampleController::class, 'createOneSample']);
Route::get('sample/{sample_id}/playlist/{playlist_id}', [SampleController::class, 'obtainOneSampleFromOnePlaylist']);
Route::get('sample/delete/{sample_id}/playlist/{playlist_id}', [SampleController::class, 'deleteOneSampleFromOnePlaylist']);
Route::post('sample/update/{sample_id}/playlist/{playlist_id}', [SampleController::class, 'updateOneSampleFromOnePlaylist']);

