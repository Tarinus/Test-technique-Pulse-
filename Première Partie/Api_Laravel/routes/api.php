<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CardController;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
     
 Route::middleware('auth:sanctum')->group( function () {
    Route::resource('cards', CardController::class);
    Route::get('usercard/{id}', [AuthController::class, 'shows']);
    Route::get('profile', [AuthController::class, 'getUser']);
    Route::put('updateuser', [AuthController::class, 'update']);
 });