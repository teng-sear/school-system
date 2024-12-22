<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');
        Route::get('table', [AdminController::class, 'table'])->name('admin.table');

        // academic year
        Route::get('academic-year/create', [AcademicYearController::class, 'index'])->name('academic-year.create');
        Route::post('academic-year/store', [AcademicYearController::class, 'store'])->name('academic-year.store');
        Route::get('academic-year/read', [AcademicYearController::class, 'read'])->name('academic-year.read');
        Route::delete('academic-year/delete/{id}', [AcademicYearController::class, 'delete'])->name('academic-year.delete');
        Route::get('academic-year/edit/{id}', [AcademicYearController::class, 'edit'])->name('academic-year.edit');
        Route::put('academic-year/update', [AcademicYearController::class, 'update'])->name('academic-year.update');

        // classes management
        Route::get('class/create', [ClassesController::class, 'index'])->name('class.create');
        Route::post('class/store', [ClassesController::class, 'store'])->name('class.store');
    });
});
