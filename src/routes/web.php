<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListController;

Route::get('/', [UserController::class, "index"])->name('index');


Route::get('/clientlist', [ListController::class, "clientList"])->name('clientList');
Route::get('/clientlist/create', [ListController::class, "clientCreate"])->name('clientCreate');
Route::post('/client_create_request', [ListController::class, "clientStore"])->name('clientStore');
Route::get('/clientlist/edit', [ListController::class, "clientEdit"])->name('clientEdit');
Route::patch('/clientlist/{client}', [ListController::class, "clientUpdate"])->name('clientUpdate');
Route::get('/clientlist/hidden', [ListController::class, "clientHidden"])->name('clientHidden');
Route::patch('/client/{client}/hide',[ListController::class, "clientHide"])->name('clientHide');
Route::patch('/client/{client}/unhide',[ListController::class, "clientUnhide"])->name('clientUnhide');
Route::delete('clientlist/{client}/destroy', [ListController::class, "clientDestroy"])->name("clientDestroy");

Route::get('/routelist', [ListController::class, 'routeList'])->name('routeList');
Route::get('/routelist/edit', [ListController::class, "routeEdit"])->name('routeEdit');
Route::get('/routelist/create', [ListController::class, 'routeCreate'])->name('routeCreate');
Route::patch('/routelist/{route}', [ListController::class, "routeUpdate"])->name('routeUpdate');
Route::post('/route_create_request', [ListController::class, 'routeStore'])->name('routeStore');
Route::delete('routelist/{route}/destroy', [ListController::class, "routeDestroy"])->name("routeDestroy");
