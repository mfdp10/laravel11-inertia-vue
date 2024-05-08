<?php

use Illuminate\Support\Facades\Route;
use Src\admin\task_category\infrastructure\controllers\GetAllTaskCategoriesGETController;
use Src\admin\task_category\infrastructure\controllers\GetTaskCategoryByIDGETController;
use Src\admin\task_category\infrastructure\controllers\CreateTaskCategoryPOSTController;
use Src\admin\task_category\infrastructure\controllers\DeleteTaskCategoryGETController;
use Src\admin\task_category\infrastructure\controllers\UpdateTaskCategoryPOSTController;

//Route::middleware(['auth:sanctum'])->get('/', [GetAllTaskCategoriesGETController::class, 'index']);
Route::get('/', [GetAllTaskCategoriesGETController::class, 'index']);
Route::get('/detail/{id}', [GetTaskCategoryByIDGETController::class, 'index']);
Route::post('/', [CreateTaskCategoryPOSTController::class, 'index']);
Route::post('/update/{id}', [UpdateTaskCategoryPOSTController::class, 'index']);
Route::get('/delete/{id}', [DeleteTaskCategoryGETController::class, 'index']);
