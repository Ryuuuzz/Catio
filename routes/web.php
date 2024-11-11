<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;

// Welkome
Route::get('/', function () {
    return view('welcome');
});

// rute home page
Route::get('/Home/index', [HomepageController::class, 'index'])->name('home');

// rute auth user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // Rute tab favorit
    Route::post('/favorite/{type}/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorite/index', [FavoriteController::class, 'index'])->name('favorites.index');



    // Kontrol User
    Route::resource('admin/users', UserController::class)->names([
        'user' => 'admin.dashboard',
    ]);
});

// rute gallery publik
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/show/{encryptedId}', [GalleryController::class, 'show'])->name('gallery.show');

// rute artikel publik
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/show/{encryptedId}', [ArticleController::class, 'show'])->name('articles.show');

// Rute admin gallery
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // rute admin artikel
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

            // Rute dashboard admin
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
        
        // Rute sampah artikel
        Route::get('/articles/trashed', [ArticleController::class, 'trashed'])->name('articles.trashed');
        Route::post('articles/{id}/restore', [ArticleController::class, 'restore'])->name('articles.restore');
        Route::delete('articles/{id}/force-delete', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete');
    });

    // Rute sampah gallery
    Route::get('gallery/trashed', [GalleryController::class, 'trashed'])->name('gallery.trashed');
    Route::post('gallery/{id}/restore', [GalleryController::class, 'restore'])->name('gallery.restore');
    Route::delete('gallery/{id}/force-delete', [GalleryController::class, 'forceDelete'])->name('gallery.forceDelete');
});

require __DIR__ . '/auth.php';
