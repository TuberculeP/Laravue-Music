<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiPlaylistController extends Controller
{
    public function index(Request $request) {
        $user = $request->user;
        $playlists = $user->playlists()->with(['tracks'])->get();
        return $playlists;
    }
}
