<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//auth route
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

//app route
Route::middleware([CheckIsLogged::class])->group(function(){
    //user logado
    Route::get('/logout', [AuthController::class, 'logout']);
    route::get('/', [MainController::class, 'index']);
    Route::get('/newNote',[MainController::class, 'newNote']);
});



