<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/',[StudentController::class,'showStudents']);
// union data
Route::get('/union',[StudentController::class,'unionData']);

// whendata
Route::get('/when',[StudentController::class,'whenData']);

// chunk data
Route::get('/chunk',[StudentController::class,'chunkData']);
