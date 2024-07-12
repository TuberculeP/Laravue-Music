<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'artist',
        'image',
        'music',
        'visible',
        'play_count',
        'album',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

     public function playlists() {
        return $this->belongsToMany(Playlist::class);
    }
}
