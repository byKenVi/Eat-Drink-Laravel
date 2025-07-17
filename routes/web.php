<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
});

// Dashboard participant (par défaut)
Route::get('/dashboard', function () {
    return view('participant.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes spécifiques par rôle
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/entrepreneur/dashboard', function () {
        return view('entrepreneur.dashboard');
    })->name('entrepreneur.dashboard');

    Route::get('/stand/status', function () {
        return view('stand.status', ['status' => auth()->user()->status]);
    })->name('stand.status');
});

require __DIR__.'/auth.php';

// 4️⃣ Tes vues Blade à créer

// Crée ces fichiers dans resources/views/ :

// resources/views/participant/dashboard.blade.php


// resources/views/admin/dashboard.blade.php


// resources/views/entrepreneur/dashboard.blade.php

// resources/views/stand/status.blade.php

