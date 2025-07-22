<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/demandes/{utilisateur}/approuver', [AdminController::class, 'approuverDemande'])->name('admin.approuver_demande');
        Route::post('/demandes/{utilisateur}/rejeter', [AdminController::class, 'rejeterDemande'])->name('admin.rejeter_demande');
    });