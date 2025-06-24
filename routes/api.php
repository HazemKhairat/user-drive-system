<?php

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Drive\DriveController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth Routes 

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [LogOutController::class, 'logout']);
});


// Drive Routes
Route::middleware('auth:sanctum')->prefix('drive')->name('drive.')->group(function () {
    
    Route::get('/public', [DriveController::class, 'publicDrive']);
    Route::post('/store', [DriveController::class, 'store']);

    // methods with id
    Route::post('/update/{id}', [DriveController::class, 'update']);
    Route::post('/delete/{id}', [DriveController::class, 'destroy']);
    Route::put('/change_status/{id}', [DriveController::class, 'change_status']); 
    Route::get('/download/{id}', [DriveController::class, 'download']);
});
