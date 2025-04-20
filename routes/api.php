<?php

use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => "auth"], function(){
    
    Route::post('signup',[ JwtAuthController::class, 'register']);
    Route::post('signin',[ JwtAuthController::class, 'login']);
    Route::get('profile', [JwtAuthController::class, 'profile'])->middleware('jwtauthmiddleware');
    Route::post('logout',[ JwtAuthController::class, 'logout'])->middleware('jwtauthmiddleware');
    
});


Route::group(['middleware' => 'jwtauthmiddleware'], function(){
    Route::apiResource('posts', PostController::class );
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('mechanics', MechanicController::class);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('applications', ApplicationController::class);
    Route::apiResource('environments', EnvironmentController::class);
});