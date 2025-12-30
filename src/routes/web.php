<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListController;

Route::get('/', [UserController::class, "index"])->name('index');


Route::get('/clientlist', [ListController::class, "clientList"])->name('clientList');
Route::get('clientlist/create', [ListController::class, "clientCreate"])->name('clientCreate');
Route::post('/client_create_request', [ListController::class, "clientStore"])->name('clientStore');
