<?php

use App\Http\Controllers\UserPosition;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPosition::class, 'index']);
// Add User Position
Route::post('/add-user-position', [UserPosition::class, 'create'])->name('add_user_position');
// Sort by Position Name
Route::get('/', [UserPosition::class, 'index'])->name('filter_position_name');


