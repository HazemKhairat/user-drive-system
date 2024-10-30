<?php

use App\Http\Controllers\DriveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/error403', [UserController::class, 'error403'])->name('error403');
    Route::get('/listUsers', [UserController::class, 'index'])->name('listUsers')->middleware('superAdmin');
    Route::get('/edit_user_rule/{id}', [UserController::class, 'edit_user_rule'])->name('edit_user_rule')->middleware('superAdmin');
    Route::post('/update_rule/{id}', [UserController::class, 'update_rule'])->name('update_rule')->middleware('superAdmin');

    // Drive Routes
    Route::prefix('drive')->name('drive.')->group(function () {
        Route::get('/publicDrive', [DriveController::class, 'publicDrive'])->name('publicDrive');

        Route::get('/index', [DriveController::class, 'index'])->name('index');
        Route::get('/create', [DriveController::class, 'create'])->name('create');
        Route::post('/store', [DriveController::class, 'store'])->name('store');
        // function with id 
        Route::get('/show/{id}', [DriveController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [DriveController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DriveController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [DriveController::class, 'destroy'])->name('destroy');
        Route::get('/download/{id}', [DriveController::class, 'download'])->name('download');
        Route::get('change_status/{id}', [DriveController::class, 'change_status'])->name('change_status');
    });

    // Rule Routes
    Route::middleware('superAdmin')->group(function () {
        Route::prefix('rule')->name('rule.')->group(function () {
            Route::get('/index', [RuleController::class, 'index'])->name('index');
            Route::get('/create', [RuleController::class, 'create'])->name('create');
            Route::post('/store', [RuleController::class, 'store'])->name('store');
            // function with id 
            Route::get('/edit/{id}', [RuleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [RuleController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [RuleController::class, 'destroy'])->name('destroy');
        });
    });
});


require __DIR__ . '/auth.php';
