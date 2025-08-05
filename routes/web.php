<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkReceptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes protégées par authentification pour les formulaires de réception
Route::middleware('auth')->group(function () {
    // Dashboard des formulaires
    Route::get('/work-reception', [WorkReceptionController::class, 'index'])
        ->name('work-reception.index');

    // Créer un nouveau formulaire
    Route::get('/work-reception/create', [WorkReceptionController::class, 'create'])
        ->name('work-reception.create');

    // Éditer un formulaire existant
    Route::get('/work-reception/{workReception}/edit', [WorkReceptionController::class, 'edit'])
        ->name('work-reception.edit');

    // Sauvegarder le formulaire (création ou modification)
    Route::post('/work-reception', [WorkReceptionController::class, 'store'])
        ->name('work-reception.store');

    // Supprimer un formulaire
    Route::delete('/work-reception/{workReception}', [WorkReceptionController::class, 'destroy'])
        ->name('work-reception.destroy');

    Route::get('/api/cities/{postalCode}', [WorkReceptionController::class, 'getCities'])
        ->name('api.cities');
});

require __DIR__ . '/auth.php';
