<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
'email' => ['required', 'string', 'email'],
'password' => ['required', 'string'],
]);
if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ]);
}

$request->session()->regenerate();

$user = Auth::user();

// Redirection selon le rôle
if ($user->role === 'admin') {
    return redirect()->route('admin.dashboard');
}

if ($user->role === 'entrepreneur') {
    if ($user->status === 'pending') {
        return redirect()->route('stand.status');
    }
    return redirect()->route('entrepreneur.dashboard');
}

// Par défaut pour les visiteurs / autres
return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
