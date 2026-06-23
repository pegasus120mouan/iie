<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedPopupController as AdminFeaturedPopupController;
use App\Http\Controllers\Admin\FormationController as AdminFormationController;
use App\Http\Controllers\Admin\GalerieController as AdminGalerieController;
use App\Http\Controllers\Admin\InscriptionController as AdminInscriptionController;
use App\Http\Controllers\Admin\TemoignageController as AdminTemoignageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');

Route::get('/formations', [FormationController::class, 'index'])->name('formations.index');
Route::get('/formations/{slug}', [FormationController::class, 'show'])->name('formations.show');

Route::get('/inscription', [InscriptionController::class, 'create'])->name('inscription.create');
Route::get('/formation-en-vue/{slug}', [InscriptionController::class, 'createFromFeatured'])->name('formation-en-vue.inscription');
Route::post('/inscription', [InscriptionController::class, 'store'])->middleware('throttle:forms')->name('inscription.store');
Route::get('/inscription/succes/{numero}', [InscriptionController::class, 'success'])
    ->middleware('signed')
    ->name('inscription.success');

Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{slug}', [ActualiteController::class, 'show'])->name('actualites.show');

Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:forms')->name('contact.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:login')->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('formations', AdminFormationController::class)->except(['show']);
        Route::resource('inscriptions', AdminInscriptionController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('actualites', AdminActualiteController::class)->except(['show']);
        Route::resource('temoignages', AdminTemoignageController::class)->except(['show']);
        Route::resource('galeries', AdminGalerieController::class)->except(['show']);
        Route::resource('featured-popups', AdminFeaturedPopupController::class)->except(['show']);
        Route::patch('featured-popups/{featured_popup}/toggle', [AdminFeaturedPopupController::class, 'toggle'])->name('featured-popups.toggle');
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::resource('users', AdminUserController::class)->except(['show']);
    });
});
