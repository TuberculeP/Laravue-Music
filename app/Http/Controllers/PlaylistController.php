<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $playlists = $user->playlists()->withCount(['tracks'])->get();

        return Inertia::render('Playlist/Index', [
            'playlists' => $playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tracks = Track::where('visible', true)->get();
        return Inertia::render('Playlist/Create', [
            'tracks' => $tracks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'tracks' => 'array',
            'tracks.*' => ['required', 'string'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->get();

        if ($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages(['tracks' => 'One or more tracks does not exist.']);
        }

        $playlist = Playlist::create([
            'uuid' => 'pl-' . Str::uuid(),
            'user_id' => $request->user()->id,
            'title' => $request->title,
        ]);

        $playlist->tracks()->attach($tracks->pluck('id'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        $tracks = $playlist->tracks()->get();
        return Inertia::render('Playlist/Show', [
            'playlist' => $playlist,
            'tracks' => $tracks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        $tracks = Track::where('visible', true)->get();
        return Inertia::render('Playlist/Edit', [
            'playlist' => $playlist->load(['tracks' => function ($query) {
                $query->select('tracks.id', 'tracks.uuid');
            }]),
            'tracks' => $tracks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'tracks' => 'array',
            'tracks.*' => ['required', 'string'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->get();

        if ($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages(['tracks' => 'One or more tracks does not exist.']);
        }

        $playlist->update([
            'title' => $request->title,
        ]);
        // attach ça push, detach ça pop et sync ça replace
        $playlist->tracks()->sync($tracks->pluck('id'));

        $playlist->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->tracks()->detach();
        $playlist->delete();
    }
}
