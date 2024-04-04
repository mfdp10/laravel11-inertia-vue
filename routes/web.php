<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskCategoryController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

//No auth routes
Route::get(
    '/',
    [DashboardController::class, "index"]
);

// change language
Route::get("lang/{lang}", [LanguageController::class, "switchLang"])->name("lang");

//Auth routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "dashboard"])->name('dashboard');
    Route::resource("/roles", RoleController::class)->names("roles");
    Route::resource("/tasks", TaskCategoryController::class)->names("tasks");
    Route::resource("/customers", CustomerController::class)->names("customers");
    Route::resource("/products", TaskCategoryController::class)->names("products");
    Route::resource("/task-categories", TaskCategoryController::class)->names("task-categories");
    Route::resource("/product-categories", ProductCategoryController::class)->names("product-categories");
});
