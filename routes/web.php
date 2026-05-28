<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\HorairesController;
use App\Http\Controllers\FournituresController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\ActualitesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CalendrierController as AdminCalendrierController;
use App\Http\Controllers\SetupController;

// ─── Setup initial (one-shot, bloqué si users exist) ──────────────────────
Route::get('/setup',  [SetupController::class, 'index'])->name('setup');
Route::post('/setup', [SetupController::class, 'store'])->name('setup.store');

Route::get('/',                     [HomeController::class,        'index'])->name('home');
Route::get('/a-propos',             [AboutController::class,       'index'])->name('about');
Route::get('/les-classes',          [ClassesController::class,     'index'])->name('classes');
Route::get('/les-horaires',         [HorairesController::class,    'index'])->name('horaires');
Route::get('/fournitures-scolaires',[FournituresController::class, 'index'])->name('fournitures');
Route::get('/calendrier-scolaire',  [CalendrierController::class,  'index'])->name('calendrier');
Route::get('/inscription',          [InscriptionController::class, 'index'])->name('inscription');
Route::get('/galleries',            [GalleriesController::class,   'index'])->name('galleries');
Route::get('/actualites',             [ActualitesController::class,  'index'])->name('actualites');
Route::get('/actualites/{actualite}', [ActualitesController::class,  'show'])->name('actualites.show');
Route::get('/contact',              [ContactController::class,     'index'])->name('contact');
Route::post('/contact',             [ContactController::class,     'send'])->name('contact.send')->middleware('throttle:10,1');

// ─── Admin ────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',   [AuthController::class, 'loginForm'])->name('login');
    Route::post('login',  [AuthController::class, 'login'])->name('login.post')->middleware('throttle:6,1');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('actualites',  ActualiteController::class);
        Route::resource('temoignages', TemoignageController::class);

        Route::get('messages',                [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}',      [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}',   [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('parametres',  [SettingController::class, 'index'])->name('settings.index');
        Route::post('parametres', [SettingController::class, 'update'])->name('settings.update');

        Route::get('documents',                  [DocumentController::class, 'index'])->name('documents.index');
        Route::post('documents/{code}/upload',   [DocumentController::class, 'upload'])->name('documents.upload');

        Route::resource('utilisateurs', UserController::class)->except(['show']);

        Route::resource('calendrier', AdminCalendrierController::class)->except(['show']);
    });
});
