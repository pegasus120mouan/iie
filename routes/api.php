<?php

use App\Http\Controllers\Api\InscriptionApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.token')->prefix('v1')->group(function () {
    Route::get('/inscriptions', [InscriptionApiController::class, 'index']);
    Route::get('/inscriptions/numero/{numero}', [InscriptionApiController::class, 'showByNumero']);
    Route::get('/inscriptions/{inscription}', [InscriptionApiController::class, 'show']);
});
