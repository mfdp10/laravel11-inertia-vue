<?php

namespace Src\admin\task_category\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\task_category\application\GetAllUseCase;
use Src\admin\task_category\infrastructure\repositories\EloquentTaskCategoryRepository;
use Illuminate\Http\JsonResponse;

class GetAllTaskCategoriesGETController extends Controller
{
    public function index(): JsonResponse
    {
        $use_case = new GetAllUseCase(new EloquentTaskCategoryRepository());
        return response()->json($use_case());
    }
}
