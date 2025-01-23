<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\ParentMiddleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);


Route::get('admin/admin/list', function () {
    return view('admin.admin.list');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

});

Route::middleware(TeacherMiddleware::class)->group(function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

});

Route::middleware(StudentMiddleware::class)->group(function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});

Route::middleware(ParentMiddleware::class)->group(function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

});
