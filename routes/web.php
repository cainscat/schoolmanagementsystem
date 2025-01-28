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
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

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

    //Student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);

    //Class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    //Subject url
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    //Subject url
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);

    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

});

Route::middleware(TeacherMiddleware::class)->group(function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);


});

Route::middleware(StudentMiddleware::class)->group(function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);


});

Route::middleware(ParentMiddleware::class)->group(function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);


});
