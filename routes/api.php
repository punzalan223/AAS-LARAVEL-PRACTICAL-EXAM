<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPosition;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user-positions', [UserPosition::class, 'indexAPI']); // View all positions
Route::get('/user-position/{id}', [UserPosition::class, 'show']); // View position details
Route::post('/user-position', [UserPosition::class, 'createAPI']); // Create new position
Route::put('/user-position/{id}', [UserPosition::class, 'update']); // Update position
Route::delete('/user-position/{id}', [UserPosition::class, 'destroy']); // Delete position