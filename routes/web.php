<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AISettingController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\AIProductController;


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


    Route::resource('companies', CompanyController::class);
    Route::get(
        'companies-trash',
        [CompanyController::class,'trash']
    )->name('companies.trash');

    Route::post(
        'companies/{id}/restore',
        [CompanyController::class,'restore']
    )->name('companies.restore');

    Route::delete(
        'companies/{id}/force-delete',
        [CompanyController::class,'forceDelete']
    )->name('companies.forceDelete');

    Route::get(
        'companies-export-excel',
        [CompanyController::class,'exportExcel']
    )->name('companies.export.excel');

    Route::get(
        'companies-export-pdf',
        [CompanyController::class,'exportPdf']
    )->name('companies.export.pdf');

    Route::resource('products', ProductController::class);

    Route::get(
        'products/trash',
        [ProductController::class, 'trash']
    )->name('products.trash');

    Route::post(
        'products/{id}/restore',
        [ProductController::class, 'restore']
    )->name('products.restore');

    Route::delete(
        'products/{id}/force-delete',
        [ProductController::class, 'forceDelete']
    )->name('products.forceDelete');

    Route::get(
        'products/export/excel',
        [ProductController::class, 'exportExcel']
    )->name('products.export.excel');

    Route::get(
        'products/export/pdf',
        [ProductController::class, 'exportPdf']
    )->name('products.export.pdf');

    Route::resource('/leads',LeadController::class)->except('show');

    Route::get(
        'leads/trash',
        [LeadController::class,'trash']
    )->name('leads.trash');

    Route::post(
        'leads/{id}/restore',
        [LeadController::class,'restore']
    )->name('leads.restore');

    Route::delete(
        'leads/{id}/force-delete',
        [LeadController::class,'forceDelete']
    )->name('leads.forceDelete');

    Route::get(
        'leads/export/excel',
        [LeadController::class, 'exportExcel']
    )
    ->name('leads.export.excel');


    Route::get(
        'leads/export/pdf',
        [LeadController::class, 'exportPdf']
    )
    ->name('leads.export.pdf');

    Route::resource('tasks', TaskController::class)->except('show');

    Route::get(
        'tasks/trash',
        [TaskController::class, 'trash']
    )->name('tasks.trash');

    Route::post(
        'tasks/{id}/restore',
        [TaskController::class, 'restore']
    )->name('tasks.restore');

    Route::delete(
        'tasks/{id}/force-delete',
        [TaskController::class, 'forceDelete']
    )->name('tasks.forceDelete');

    Route::get(
        'tasks-export-excel',
        [TaskController::class, 'exportExcel']
    )->name('tasks.export.excel');

    Route::get(
        'tasks-export-pdf',
        [TaskController::class, 'exportPdf']
    )->name('tasks.export.pdf');


    Route::resource('ai-settings', AISettingController::class)->except('show');

    Route::get(
        'ai-settings/trash',
        [AISettingController::class,'trash']
    )->name('ai-settings.trash');

    Route::post(
        'ai-settings/{id}/restore',
        [AISettingController::class,'restore']
    )->name('ai-settings.restore');

    Route::delete(
        'ai-settings/{id}/force-delete',
        [AISettingController::class,'forceDelete']
    )->name('ai-settings.forceDelete');

    Route::post(
        'ai-settings/test-connection',
        [AISettingController::class,'testConnection']
    )->name('ai-settings.test');

    Route::post(
        '/ai-settings/testGemini',
        [AISettingController::class, 'testConnectionGemini']
    )->name('ai-settings.testGemini');

    Route::get('/gemini-test', [GeminiController::class, 'test']);

    Route::post(
        '/ai/product-description',
        [AIProductController::class, 'generateDescription']
    )->name('ai.product.description');

    
});

require __DIR__.'/auth.php';
