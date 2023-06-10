<?php

use Lib\Route;
use App\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function () {   return ['title'=>'contacto','content'=>'contenido contacto'];});
Route::get('/about', function () {   return "hola mundo acerca";});

Route::get('/curso/:slug', function ($slug) {   return "el curso es ".$slug;});

Route::dispatch();