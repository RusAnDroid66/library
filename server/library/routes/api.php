<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->post('/book/add', [BookController::class, 'add']);

Route::middleware('auth:sanctum')->get('/book/all', [BookController::class, 'all']);

Route::middleware('auth:sanctum')->get('/book/delete/{id}', [BookController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/book/change_availability/{id}', [BookController::class, 'changeAvailabilty']);

Route::post('/token/get',  [AuthController::class, 'getToken']);
