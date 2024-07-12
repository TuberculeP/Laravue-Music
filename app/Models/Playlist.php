<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'uuid',
        'user_id',
    ];
    public function tracks() {
        return $this->belongsToMany(Track::class);
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
