<?php

use App\Controllers\ContactController;
use App\Controllers\DispositivoController;
use App\Controllers\TemperaturaController;
use Lib\Route;
use App\Controllers\HomeController;



Route::get('/',[HomeController::class, 'index']);
Route::get('/contacts',[ContactController::class, 'index']);
Route::get('/contacts/create',[ContactController::class, 'create']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/:id',  [ContactController::class, 'show']);
Route::get('/contacts/:id/edit',  [ContactController::class, 'edit']);
Route::post('/contacts/:id',  [ContactController::class, 'update']);
Route::post('contacts/:id/delete', [ContactController::class, 'destroy']);


Route::get('/dispositivo',[DispositivoController::class, 'index']);
Route::get('/dispositivo/create',[DispositivoController::class, 'create']);
Route::post('/dispositivo', [DispositivoController::class, 'store']);
Route::get('/dispositivo/:id',  [DispositivoController::class, 'show']);
Route::get('/dispositivo/:id/edit',  [DispositivoController::class, 'edit']);
Route::post('/dispositivo/:id',  [DispositivoController::class, 'update']);
Route::post('dispositivo/:id/delete', [DispositivoController::class, 'destroy']);


Route::get('/temperatura',[TemperaturaController::class, 'index']);
Route::get('/temperatura/create',[TemperaturaController::class, 'create']);
Route::post('/temperatura', [TemperaturaController::class, 'store']);
Route::get('/temperatura/:id',  [TemperaturaController::class, 'show']);
Route::get('/temperatura/:id/edit',  [TemperaturaController::class, 'edit']);
Route::post('/temperatura/:id',  [TemperaturaController::class, 'update']);
Route::post('temperatura/:id/delete', [TemperaturaController::class, 'destroy']);


Route::get('/temp',[ContactController::class, 'index']);

Route::dispatch();
