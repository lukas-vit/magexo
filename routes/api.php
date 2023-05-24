<?php

use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');

Route::post('/employees', [EmployeesController::class, 'store']);

Route::put('/employees/{employee}',  [EmployeesController::class, 'update']);

Route::delete('/employees/{employee}',  [EmployeesController::class, 'destroy']);
