<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaFormatController;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\InterestController;

// Rotas de Autenticação
Auth::routes();

// Página Inicial (Vitrine Pública)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']); 

// --- ÁREA DO CLIENTE / INTERAÇÕES ---
// Registro de interesse (acessível para usuários logados ou visitantes, conforme sua lógica de Controller)
Route::post('/items/{item}/interest', [InterestController::class, 'store'])->name('interests.store');

// --- ÁREA RESTRITA (Requer Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Central de Leads / Meus Interesses
    Route::get('/admin/interests', [InterestController::class, 'index'])->name('interests.index');
    
    // ROTA QUE ESTAVA FALTANDO: Deletar/Cancelar Interesse
    Route::delete('/admin/interests/{interest}', [InterestController::class, 'destroy'])->name('interests.destroy');

    // CRUDs de Gerenciamento do Estoque
    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('formats', MediaFormatController::class);
});