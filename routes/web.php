<?php

use App\Enums\UserRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstateController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EstateController::class, 'index'])->name('home');;

Route::middleware('auth')->group(function () {
    

    Route::prefix('estates')->group(function () {
        Route::post('/', [EstateController::class, 'createEstate']);
        Route::patch('{id}', [EstateController::class, 'updateOne']);
        Route::get('{id}/edit', [EstateController::class, 'showOne']);
        Route::get('/create', [AdminController::class, 'showCreateEstate']);

        Route::get('{id}', [EstateController::class, 'findOne'])->name('estate');
    });

    Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin');
    Route::get('/roles', function () {
        return Inertia::render('Roles', [
            'user' => Auth::user(),
            'roles' => UserRole::roles(),
            'users' => User::all()
        ]);
    });
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);
