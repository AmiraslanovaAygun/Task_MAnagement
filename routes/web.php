<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'login')->name('loginPost');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/register', 'register')->name('register');
    Route::post('/profile', 'updateProfile')->name('updateProfile');
    Route::delete('/delete/{user}', 'destroy')->name('deleteUser');
    Route::post('/positions', 'createPosition')->name('createPosition');
    Route::delete('/positions/{position}', 'deletePosition')->name('deletePosition');
});

Route::name('app.')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });
});

Route::name('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/projects', 'project')->name('project');
        Route::get('/tasks', 'task')->name('task');
        Route::get('/users', 'user')->name('user');
        Route::get('/managers', 'manager')->name('manager');
        Route::get('/positions', 'position')->name('position');
        Route::get('/profile', 'profile')->name('profile');
    });
});
