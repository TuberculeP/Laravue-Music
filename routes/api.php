<?php

use App\Http\Controllers\API\ApiPlaylistController;
use App\Http\Middleware\CheckAPIKey;
use Illuminate\Support\Facades\Route;

Route::get('/playlists', [ApiPlaylistController::class, 'index'])->middleware(CheckAPIKey::class);
