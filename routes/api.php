<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabookController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\CategorybookController;
use App\Http\Controllers\TransaksiPinjamController;
use App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/databooks', [DatabookController::class, 'index']);
Route::get('/databooks/{id}', [DatabookController::class, 'show']);
Route::post('/databooks', [DatabookController::class, 'store']);
Route::put('/databooks/{id}', [DatabookController::class, 'update']);
Route::delete('/databooks/{id}', [DatabookController::class, 'destroy']);

Route::get('/penerbits', [PenerbitController::class, 'index']);
Route::get('/penerbits/{id}', [PenerbitController::class, 'show']);
Route::post('/penerbits', [PenerbitController::class, 'store']);
Route::put('/penerbits/{id}', [PenerbitController::class, 'update']);
Route::delete('/penerbits/{id}', [PenerbitController::class, 'destroy']);

Route::get('/categories', [CategorybookController::class, 'index']);
Route::get('/categories/{id}', [CategorybookController::class, 'show']);
Route::post('/categories', [CategorybookController::class, 'store']);
Route::put('/categories/{id}', [CategorybookController::class, 'update']);
Route::delete('/categories/{id}', [CategorybookController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}',  [UserController::class, 'update']);
Route::delete('/users/{id}',[UserController::class, 'destroy']);

Route::get('/admins', [AdminController::class, 'index']);
Route::get('/admins/{id}', [AdminController::class, 'show']);
Route::post('/admins', [AdminController::class, 'store']);
Route::put('/admins/{id}',  [AdminController::class, 'update']);
Route::delete('/admins/{id}',[AdminController::class, 'destroy']);

Route::get('/pinjams', [TransaksiPinjamController::class, 'index']);
Route::get('/pinjams/{id}', [TransaksiPinjamController::class, 'show']);
Route::post('/pinjams', [TransaksiPinjamController::class, 'store']);
Route::put('/pinjams/{id}',  [TransaksiPinjamController::class, 'update']);
Route::delete('/pinjams/{id}',[TransaksiPinjamController::class, 'destroy']);
