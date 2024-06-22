<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate2
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un administrateur
        if (Auth::check() && auth()->user()->role == 'admin') {
            // Autorise la requête à continuer
            return $next($request);
        } else {
            // Redirige l'utilisateur vers la page précédente
             abort(403);
        }
    }
}
