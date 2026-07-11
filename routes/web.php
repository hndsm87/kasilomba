<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $totalSubmissions = \App\Models\Photo::count();
    return view('pages.home', compact('totalSubmissions'));
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

Route::get('/track', [\App\Http\Controllers\TrackController::class, 'index'])->name('track.index');
Route::post('/track', [\App\Http\Controllers\TrackController::class, 'search'])->name('track.search');

Route::get('/register', function () {
    return view('pages.register');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Placeholders for now)
Route::middleware(['auth'])->group(function () {
    
    // Shared Admin Routes (Admin & Admin Verifikasi)
    Route::middleware(['role:Admin|Admin Verifikasi'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        
        // Verification Routes
        Route::get('/submissions', [\App\Http\Controllers\VerificationController::class, 'index'])->name('submissions.index');
        Route::get('/submissions/{photo}', [\App\Http\Controllers\VerificationController::class, 'show'])->name('submissions.show');
        Route::post('/submissions/{photo}/approve', [\App\Http\Controllers\VerificationController::class, 'approve'])->name('submissions.approve');
        Route::post('/submissions/{photo}/reject', [\App\Http\Controllers\VerificationController::class, 'reject'])->name('submissions.reject');

        Route::get('/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
        Route::post('/reports/{report}/resolve', [\App\Http\Controllers\AdminController::class, 'resolveReport'])->name('reports.resolve');
        
        Route::get('/results', [\App\Http\Controllers\AdminController::class, 'results'])->name('results');
        
        // Super Admin Only Routes
        Route::middleware(['role:Admin'])->group(function () {
            // Criteria Management
            Route::get('/criteria', [\App\Http\Controllers\CriteriaController::class, 'index'])->name('criteria.index');
            Route::post('/criteria', [\App\Http\Controllers\CriteriaController::class, 'store'])->name('criteria.store');
            Route::put('/criteria/{criteria}', [\App\Http\Controllers\CriteriaController::class, 'update'])->name('criteria.update');
            Route::delete('/criteria/{criteria}', [\App\Http\Controllers\CriteriaController::class, 'destroy'])->name('criteria.destroy');

            // User Management
            Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
            Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
            Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        });
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
