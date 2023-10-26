<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

//books
Route::apiResource('/books', App\Http\Controllers\Api\BookController::class);

//anggota
Route::apiResource('/register', RegisterController::class);

//feedback
Route::apiResource('/feedback', App\Http\Controllers\Api\RatingController::class);

//history
Route::apiResource('/history', App\Http\Controllers\Api\HistoryController::class);
