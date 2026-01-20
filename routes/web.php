<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//auth route
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro');
    Route::post('/cadastroSubmit', [AuthController::class, 'cadastroSubmit'])->name('cadastroSubmit');
});

//app route -- user logged
Route::middleware([CheckIsLogged::class])->group(function(){
    //user logado
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [MainController::class, 'index'])->name('home');

    //notes
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/newNote',[MainController::class, 'newNote'])->name('new');
    //edit not
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit',[MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    //delet note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete'); 
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteConfirm');
});



