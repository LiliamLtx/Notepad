<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
    
//Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

//Crud routes
Route::middleware('auth:sanctum')->group(function () {
    //Create NewNote
    Route::post('/notes', [NoteController::class, 'store']);
    //Read
    Route::get('/notes/{id}', [NoteController::class, 'show']);
    Route::get('/notes', [NoteController::class, 'index']);
    //Update Note
    Route::put('/notes/{id}', [NoteController::class, 'update']);  
    //Delete Note
    Route::delete('/notes/{id}', [NoteController::class, 'destroy']);

    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
