<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $keys = $user->api_keys()->get();
        return Inertia::render('ApiKeys/Index', [
            'apiKeys' => $keys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ApiKeys/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
        ]);
        ApiKey::create([
            'uuid' => 'ak-' . Str::uuid(),
            'user_id' => $request->user()->id,
            'key' => 'pouet-pouet-'. Str::random(30),
            'name' => $request->name,
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $api_key)
    {
        $api_key->delete();
        return redirect()->route('api-keys.index');
    }
}
