<?php

use App\Controllers\ContactController;
use App\Controllers\DispositivoController;
use App\Controllers\TemperaturaController;
use App\Controllers\HumedadController;
use App\Controllers\TemplateController;
use Lib\Route;
use App\Controllers\HomeController;



Route::get('/',[ContactController::class, 'index']);
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
Route::get('/temperatura/ultimate',  [TemperaturaController::class, 'showUltimate']);
Route::get('/temperatura/:id/edit',  [TemperaturaController::class, 'edit']);
Route::post('/temperatura/:id',  [TemperaturaController::class, 'update']);
Route::post('temperatura/:id/delete', [TemperaturaController::class, 'destroy']);


Route::get('/humedad',[HumedadController::class, 'index']);
Route::get('/humedad/create',[HumedadController::class, 'create']);
Route::post('/humedad', [HumedadController::class, 'store']);
Route::get('/humedad/:id',  [HumedadController::class, 'show']);
Route::get('/humedad/:id/edit',  [HumedadController::class, 'edit']);
Route::post('/humedad/:id',  [HumedadController::class, 'update']);
Route::post('humedad/:id/delete', [HumedadController::class, 'destroy']);


Route::get('/temp',[ContactController::class, 'index']);

Route::dispatch();
