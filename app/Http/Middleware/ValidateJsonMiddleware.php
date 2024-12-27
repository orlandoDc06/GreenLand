<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el contenido es JSON
        if ($request->isJson()) {
            try {
                json_decode($request->getContent(), true);
            } catch (\Exception $e) {
                return response()->json(['error' => 'JSON malformado'], 400);
            }
        }

        return $next($request);
    }
}
