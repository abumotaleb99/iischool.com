<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LessonSubjectController;

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

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('reset/{remember_token}', [AuthController::class, 'showResetPasswordForm']);
Route::post('reset/{remember_token}', [AuthController::class, 'resetPassword']);
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'adminList']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    // Lesson Routes
    Route::get('admin/lesson/list', [LessonController::class, 'lessonList']);
    Route::get('admin/lesson/add', [LessonController::class, 'add']);
    Route::post('admin/lesson/add', [LessonController::class, 'insert']);
    Route::get('admin/lesson/edit/{id}', [LessonController::class, 'edit']);
    Route::post('admin/lesson/edit', [LessonController::class, 'update']);
    Route::get('admin/lesson/delete/{id}', [LessonController::class, 'delete']);

    // Subject Routes
    Route::get('admin/subject/list', [SubjectController::class, 'subjectList']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // Assign Subject Routes
    Route::get('admin/assign-subject/list', [LessonSubjectController::class, 'assignSubjectList']);
    Route::get('admin/assign-subject/add', [LessonSubjectController::class, 'add']);
    Route::post('admin/assign-subject/add', [LessonSubjectController::class, 'insert']);
    Route::get('admin/assign-subject/edit/{id}', [LessonSubjectController::class, 'edit']);
    Route::post('admin/assign-subject/edit', [LessonSubjectController::class, 'update']);
    Route::get('admin/assign-subject/delete/{id}', [LessonSubjectController::class, 'delete']);

});

Route::group(['middleware' => 'teacher'], function() {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'student'], function() {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'parent'], function() {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
});
