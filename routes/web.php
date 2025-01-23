<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\ParentMiddleware;

use App\Http\Controllers\AuthController;


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
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });

});

Route::middleware(TeacherMiddleware::class)->group(function () {
    Route::get('teacher/dashboard', function () {
        return view('admin.dashboard');
    });


});

Route::middleware(StudentMiddleware::class)->group(function () {
    Route::get('student/dashboard', function () {
        return view('admin.dashboard');
    });


});

Route::middleware(ParentMiddleware::class)->group(function () {
    Route::get('parent/dashboard', function () {
        return view('admin.dashboard');
    });


});
