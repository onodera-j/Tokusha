<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\AnswersheetController;

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

Route::get('/conditionlist', [ListController::class, "conditionList"])->name('conditionList');
Route::get('/conditionlist/edit', [ListController::class, "conditionEdit"])->name('conditionEdit');
Route::get('/conditionlist/create', [ListController::class, 'conditionCreate'])->name('conditionCreate');
Route::patch('/conditionlist/{condition}', [ListController::class, "conditionUpdate"])->name('conditionUpdate');
Route::post('/condition_create_request', [ListController::class, 'conditionStore'])->name('conditionStore');
Route::delete('conditionlist/{condition}/destroy', [ListController::class, "conditionDestroy"])->name("conditionDestroy");

Route::get('/basedata', [ListController::class,"baseData"])->name("baseData");
Route::patch('/basedata/{answersetting}', [ListController::class, "answerSettingUpdate"])->name('answerSettingUpdate');
Route::delete('basedata/{member}/destroy', [ListController::class, "staffDestroy"])->name("staffDestroy");
Route::post('/basedata/staff_create_request', [ListController::class, 'staffStore'])->name('staffStore');

Route::get('/answersheet', [AnswersheetController::class, "answersheetCreate"])->name("answerSheetCreate");
Route::get('/route-categories/{category}/routes',
    [AnswersheetController::class, 'routeByCategory'])->name('routes.byCategory');

Route::post('/answersheet/registration', [AnswersheetController::class, "answersheetRegistration"])->name('answesheetRegistration');

Route::get('/history', [AnswersheetController::class, "historyList"])->name('history');
Route::get('/history/edit', [AnswersheetController::class, "historyEdit"])->name('historyEdit');
