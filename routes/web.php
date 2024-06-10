<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/addform', [NewController::class, 'addForm'])->name('addform');
Route::get('/place', [NewController::class, 'viewplace'])->name('viewplace');
Route::get('/place/add', [NewController::class, 'addplace'])->name('addplace');
Route::match(['get', 'post'], '/place/update/{id}', [NewController::class, 'updateplace'])->name('updateplace');
Route::get('/delete-place/{id}', [NewController::class, 'deleteplace'])->name('deleteplace');