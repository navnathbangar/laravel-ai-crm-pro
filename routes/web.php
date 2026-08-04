<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::resource('/customers',CustomerController::class);
    Route::get('/customers-trash',
        [CustomerController::class,'trash'])
        ->name('customers.trash');
    Route::post('/customers/{id}/restore',
        [CustomerController::class,'restore'])
        ->name('customers.restore');
    Route::delete('customers/{id}/force-delete',
        [CustomerController::class,'forceDelete'])
        ->name('customers.forceDelete');
    Route::get('/customers/export/excel',
        [CustomerController::class,'exportExcel'])
        ->name('customers.export.excel');
    Route::get('/customers/export/pdf',
        [CustomerController::class,'exportPdf'])->name('customers.export.pdf');

    Route::resource('/companies',CompanyController::class);

    Route::resource('/products',ProductController::class);

    Route::resource('/leads',LeadController::class);

    Route::resource('/tasks',TaskController::class);
});

require __DIR__.'/auth.php';
