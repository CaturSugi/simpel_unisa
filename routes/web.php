<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuildingController;
use App\Http\Middleware\IsLogin;

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

// Route::get('/', [DashboardController::class, 'index']) -> middleware(IsLogin::class);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', [AuthController::class, 'logout']);
// Route::get('/register', [AuthController::class, 'registerView']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/forgot-password', [AuthController::class, 'forgotPasswordView']);
// Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
// Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordView']);
// Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(IsLogin::class);
 

Route::middleware([\App\Http\Middleware\IsLogin::class])->group(function () {
    
        Route::get('/dashboard', [DashboardController::class, 'index']);
    
        Route::get('/limbah', [TrashController::class, 'index']);
        Route::get('/limbah/create', [TrashController::class, 'create']);
        Route::post('/limbah/store', [TrashController::class, 'store']);
        Route::delete('/limbah/{id}', [TrashController::class, 'delete']);
        Route::get('/limbah/edit/{id}', [TrashController::class, 'edit']);
        Route::put('/limbah/{id}', [TrashController::class, 'update']);

        Route::get('/limbah/softdelete/{id}', [TrashController::class, 'softdelete']);
        Route::get('/limbah/softdelete', [TrashController::class, 'softdelete']);
        Route::get('/limbah/restore/{id}', [TrashController::class, 'restore']);
        Route::get('/limbah/restore', [TrashController::class, 'restore']);
        Route::get('/limbah/forceDelete/{id}', [TrashController::class, 'forceDelete']);
        Route::get('/limbah/forceDelete', [TrashController::class, 'forceDelete']);
    
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::post('/category/store', [CategoryController::class, 'store']);
        Route::delete('/category/{id}', [CategoryController::class, 'delete']);
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('/category/{id}', [CategoryController::class, 'update']);

        Route::get('/building', [BuildingController::class, 'index']);
        Route::get('/building/create', [BuildingController::class, 'create']);
        Route::post('/building/store', [BuildingController::class, 'store']);
        Route::delete('/building/{id}', [BuildingController::class, 'delete']);
        Route::get('/building/edit/{id}', [BuildingController::class, 'edit']);
        Route::put('/building/{id}', [BuildingController::class, 'update']);

        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/users/create', [UsersController::class, 'create']);
        Route::post('/users/store', [UsersController::class, 'store']);
        Route::delete('/users/{id}', [UsersController::class, 'delete']);
        Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
        Route::put('/users/{id}', [UsersController::class, 'update']);
        
        Route::get('/users/softdelete/{id}', [UsersController::class, 'softdelete']);
        Route::get('/users/softdelete', [UsersController::class, 'softdelete']);
        Route::get('/users/restore/{id}', [UsersController::class, 'restore']);
        Route::get('/users/restore', [UsersController::class, 'restore']);
        Route::get('/users/forceDelete/{id}', [UsersController::class, 'forceDelete']);
        Route::get('/users/forceDelete', [UsersController::class, 'forceDelete']);

        Route::get('/users/profile', [UsersController::class, 'profile']);

        Route::get('/laporan', [ReportController::class, 'index']);
        Route::get('/laporan/print', [ReportController::class, 'printPdf']);

        Route::prefix('charts')->group(function () {
            Route::get('/', [ReportController::class, 'reportchart'])->name('charts.index');
            Route::get('/building', [ReportController::class, 'chartbuilding'])->name('charts.building');
        });

});