<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PracticeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/practices/list', [PracticeController::class, 'list']);

Route::fallback(function(){
    return response()->json(['status' => false, 'message' => 'This Route does not exist. Be sure you are calling the right method with no typo'], 404);
});