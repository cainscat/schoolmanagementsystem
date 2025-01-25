<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\ParentMiddleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::post('forgot-password', [AuthController::class, 'post_forgot_password']);
Route::get('reset/{token}', [AuthController::class, 'reset_password']);
Route::post('reset/{token}', [AuthController::class, 'post_reset_password']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    //Admin url
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //Class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

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
