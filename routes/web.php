<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FieldPracticeController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/practices/{id}', [PracticeController::class, 'show'])->name('practices.show')->middleware('auth');
Route::get('/practices', [PracticeController::class, 'index'])->name('practices.index')->middleware('auth');
Route::post('/practices/create', [PracticeController::class, 'store'])->name('practices.store')->middleware('auth');
Route::get('/practices/create/new', [PracticeController::class, 'create'])->name('practices.create')->middleware('auth');
Route::get('/practices/edit/{id}', [PracticeController::class, 'edit'])->name('practices.edit')->middleware('auth');
Route::put('/practices/update', [PracticeController::class, 'update'])->name('practices.update')->middleware('auth');
Route::get('/practices/show', [PracticeController::class, 'show'])->name('practices.show')->middleware('auth');
Route::get('/practices/delete/{id}', [PracticeController::class, 'destroy'])->name('practices.destroy')->middleware('auth');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index')->middleware('auth');
Route::post('/employee/create', [EmployeeController::class, 'store'])->name('employee.store')->middleware('auth');
Route::get('/employee/create/new', [EmployeeController::class, 'create'])->name('employee.create')->middleware('auth');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('auth');
Route::put('/employee/update', [EmployeeController::class, 'update'])->name('employee.update')->middleware('auth');
Route::get('/employee/get', [EmployeeController::class, 'get'])->name('employee.get')->middleware('auth');
Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware('auth');

Route::get('/practices/fields/new', [FieldPracticeController::class, 'fields'])->name('field_practice.index')->middleware('auth');
Route::post('/practices/fields/create', [FieldPracticeController::class, 'store'])->name('field_practice.store')->middleware('auth');
Route::get('/practices/fields/create/new', [FieldPracticeController::class, 'create'])->name('field_practice.create')->middleware('auth');
Route::get('/practices/fields/edit/{id}', [FieldPracticeController::class, 'edit'])->name('field_practice.edit')->middleware('auth');
Route::put('/practices/fields/update', [FieldPracticeController::class, 'update'])->name('field_practice.update')->middleware('auth');
Route::get('/practices/fields/get', [FieldPracticeController::class, 'get'])->name('field_practice.get')->middleware('auth');
Route::get('/practices/fields/delete/{id}', [FieldPracticeController::class, 'destroy'])->name('field_practice.destroy')->middleware('auth');