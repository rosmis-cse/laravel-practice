<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
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


Route::prefix('estates')->group(function () {
    //TODO delete these unused routes once all tested

    // Route::get('/', [EstateController::class, 'index']);
    // Route::get('{id}', [EstateController::class, 'view']);

    Route::post('/', [EstateController::class, 'create']);
    Route::patch('{id}', [EstateController::class, 'updateOne']);
    Route::patch('{id}/remove', [EstateController::class, 'removeOne']);
});



Route::prefix('options')->group(function () {
    Route::get('/', [OptionController::class, 'index']);
    Route::post('/', [OptionController::class, 'createOption']);
    Route::get('{id}', [OptionController::class, 'findOne']);
    Route::patch('{id}', [OptionController::class, 'updateOne']);
    Route::patch('{id}/remove', [OptionController::class, 'removeOne']);
});

Route::prefix('admin')->group(function () {
    Route::patch('/roles/{id}', [AdminController::class, 'saveUserRole']);
});



Route::get('/roles/{id}', [AuthController::class, 'getAssociatedRolesUser']);