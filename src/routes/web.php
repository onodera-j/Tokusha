<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListController;

Route::get('/', [UserController::class, "index"])->name('index');
Route::get('/clientlist', [ListController::class, "clientList"])->name('clientList');
