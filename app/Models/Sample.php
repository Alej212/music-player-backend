<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sample_path',
    ];

    public function playlists() {
        return $this->belongsToMany(Playlist::class);
    }
}
