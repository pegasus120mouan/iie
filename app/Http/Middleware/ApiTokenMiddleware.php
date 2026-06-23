<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('iie.api_token');

        if (empty($token)) {
            return response()->json([
                'message' => 'API non configurée. Définissez IIE_API_TOKEN dans le fichier .env.',
            ], 503);
        }

        $provided = $request->bearerToken()
            ?? $request->header('X-API-Token')
            ?? $request->query('api_token');

        if (! is_string($provided) || ! hash_equals($token, $provided)) {
            return response()->json([
                'message' => 'Token API invalide ou manquant.',
            ], 401);
        }

        return $next($request);
    }
}
