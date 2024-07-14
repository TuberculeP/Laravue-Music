<?php

use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
*/

/*
Route::name('tracks')
->controller(TrackController::class)
->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('', 'store')->name('store');
    Route::get('{track}', 'show')->name('show');
    Route::get('{track}/edit', 'edit')->name('edit');
    Route::put('{track}', 'update')->name('update');
    Route::delete('{track}', 'destroy')->name('destroy');
});
*/

Route::middleware(IsAdmin::class)
    ->resource('tracks', TrackController::class)
    ->except('index');
Route::get('tracks', [TrackController::class, 'index'])->name('tracks.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('playlists', PlaylistController::class);
    Route::resource('api-keys', ApiKeyController::class);
});

Route::get('/', function () {
    return redirect()->route('tracks.index');
    /*
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    */
});