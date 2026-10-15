<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\Admin\AcademicAdminController;

// ─── Public Routes ──────────────────────────────────────────────────────────

Route::get('/', function () {
    return redirect()->route('academics.index');
});

Route::get('/academics', [AcademicController::class, 'index'])->name('academics.index');
Route::get('/academics/{slug}', [AcademicController::class, 'show'])->name('academics.show');

// ─── Auth Routes ────────────────────────────────────────────────────────────

Route::get('/admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

// ─── Admin Routes (auth protected) ──────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', fn() => redirect()->route('admin.academics.index'));

    // Academics CRUD
    Route::get('/academics', [AcademicAdminController::class, 'index'])->name('academics.index');
    Route::get('/academics/create', [AcademicAdminController::class, 'create'])->name('academics.create');
    Route::post('/academics', [AcademicAdminController::class, 'store'])->name('academics.store');
    Route::get('/academics/{academic}/edit', [AcademicAdminController::class, 'edit'])->name('academics.edit');
    Route::put('/academics/{academic}', [AcademicAdminController::class, 'update'])->name('academics.update');
    Route::delete('/academics/{academic}', [AcademicAdminController::class, 'destroy'])->name('academics.destroy');

    // Publications sub-resource
    Route::post('/academics/{academic}/publications', [AcademicAdminController::class, 'storePublication'])->name('academics.publications.store');
    Route::delete('/academics/{academic}/publications/{publication}', [AcademicAdminController::class, 'destroyPublication'])->name('academics.publications.destroy');
});
