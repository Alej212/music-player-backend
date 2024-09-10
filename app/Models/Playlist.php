<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image_path'
    ];

    //* relationship betweent user and playlist
    public function samples() {
        return $this->belongsToMany(Sample::class);
    }

    //* relationship betweent user and playlist
    public function user() {
        return $this->belongsTo(User::class);
    }

    //* Function to set image_path
    public function setImagePathAttribute($value)
    {
        $imagePath = public_path('images/' . $value);
        if (file_exists($imagePath)) {
            $this->attributes['image_path'] = 'images/' . $value;
        } else {
            // Handle the case where the image does not exist
            $this->attributes['image_path'] = 'images/default.jpg';
        }
    }
}
