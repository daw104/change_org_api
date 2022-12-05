<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user', 'show_all');
});


Route::controller(CategoryController::class)->group(function(){
    Route::post('store', 'store');
    Route::get('category/{category}', 'show');
    Route::get('category', 'show_all');
});


Route::controller(PetitionController::class)->group(function(){
    Route::post('storePetition', 'store');
    Route::get('petition/{petition}', 'show');
    Route::get('petition', 'show_all');
});

