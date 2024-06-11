<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addplace', [NewController::class, 'showForm'])->name('showform');
Route::post('/addform', [NewController::class, 'addForm'])->name('addform');
Route::get('/place', [NewController::class, 'viewplace'])->name('viewplace');
Route::get('/place/add', [NewController::class, 'addplace'])->name('addplace');
Route::match(['get', 'post'], '/place/update/{id}', [NewController::class, 'updateplace'])->name('updateplace');
Route::get('/delete-place/{id}', [NewController::class, 'deleteplace'])->name('deleteplace');

Route::post('/addformpos', [NewController::class, 'addFormpos'])->name('addformpos');
Route::get('/position', [NewController::class, 'viewposition'])->name('viewposition');
Route::get('/position/add', [NewController::class, 'addposition'])->name('addposition');
Route::match(['get', 'post'], '/position/update/{id}', [NewController::class, 'updateposition'])->name('updateposition');
Route::get('/delete-position/{id}', [NewController::class, 'deleteposition'])->name('deleteposition');


Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');