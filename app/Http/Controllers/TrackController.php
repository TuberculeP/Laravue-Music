<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Error;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::all();
        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Track/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'music' => ['required', 'file', 'mimes:mp3,flac,wav,aac,ogg', 'max:10000'],
            'image' => ['required', 'image', 'max:10000'],
            'visible' => ['required', 'boolean'],
        ]);

        $uuid = 'trk-' . Str::uuid();

        $image_path = $request->image->storeAs('tracks/images', $uuid . '.' . $request->image->extension());
        $music_path = $request->music->storeAs('tracks/tracks', $uuid . '.' . $request->image->extension());

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'visible' => $request->visible,
            'image' => $image_path,
            'music' => $music_path,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        return Inertia::render('Track/Edit', [
            'track' => $track,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'visible' => ['required', 'boolean'],
        ]);

        $track->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'visible' => $request->visible,
        ]);
        $track->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->route('tracks.index');
    }
}
