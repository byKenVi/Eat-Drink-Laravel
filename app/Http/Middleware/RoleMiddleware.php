<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            // Si non connecté, redirige vers la page de connexion (gérée par l'autre équipe)
            return redirect('/login'); // Ou toute autre route de connexion définie
        }

        $user = Auth::user();

        // Vérifie si le rôle de l'utilisateur fait partie des rôles autorisés
        if ($user->role!==$role) {
             // Si l'utilisateur n'a pas le bon rôle, renvoie une erreur 403 (Accès interdit)
        return abort(403, 'Accès non autorisé. Vous n\'avez pas la permission d\'accéder à cette page.');
        }
        else{
            return $next($request);
        };

        
    }
}

