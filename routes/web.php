<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class);

// Ajax
Route::prefix('ajax')->group(function () {
    Route::post('empreendimentos/importar/{empresa}', ImportarEmpreendimentosController::class);
});
