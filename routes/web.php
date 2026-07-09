<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/guidebook', function () {
    return view('pages.guidebook');
});

Route::get('/timeline', function () {
    return view('pages.timeline');
});

Route::get('/prizes', function () {
    return view('pages.prizes');
});

Route::get('/categories', function () {
    return view('pages.categories');
});

Route::get('/join', function () {
    return view('pages.join');
});

Route::get('/faq', function () {
    return view('pages.faq');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/register', function () {
    return view('pages.register');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Placeholders for now)
Route::middleware(['auth'])->group(function () {
    
    // Admin Routes
    Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/results', [\App\Http\Controllers\AdminController::class, 'results'])->name('results');
    });

    // Judge Routes
    Route::middleware(['role:Judge'])->prefix('judge')->name('judge.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\JudgeController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/next', [\App\Http\Controllers\JudgeController::class, 'judgeNext'])->name('next');
        Route::get('/photo/{photo}', [\App\Http\Controllers\JudgeController::class, 'judgePhoto'])->name('photo');
        Route::post('/photo/{photo}/score', [\App\Http\Controllers\JudgeController::class, 'storeScore'])->name('store_score');
        Route::post('/photo/{photo}/report', [\App\Http\Controllers\JudgeController::class, 'reportPhoto'])->name('report_photo');
        Route::get('/my-scores', [\App\Http\Controllers\JudgeController::class, 'myScores'])->name('my_scores');
    });
});

// Webhook Routes
Route::post('/webhook/fillout', [\App\Http\Controllers\Api\WebhookController::class, 'handleFillout'])->name('webhook.fillout');
