<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->headers->get("X-Api-Key");
        if (!$key) return response([
            'error' => 'API key is required',
        ], 400);
        $api_key = ApiKey::firstWhere('key', $key);
        if(!$api_key) return response([
            'error' => 'Bad API key',
        ], 401); 
        $user = $api_key->user;
        $request->merge(['user' => $user]);
        return $next($request);
    }
}
