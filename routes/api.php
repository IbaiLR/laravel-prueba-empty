<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::get('/user/{user}', [UserController::class, 'show']);

Route::post('/login', [UserController::class, 'login']);
Route::get('/user/{user}/preferences',[UserController::class, 'getPreferences' ]);
Route::get('user/{user}/tasks', [UserController::class, 'getTasks']);
Route::get('task/{task}/labels', [UserController::class, 'getLabels']);