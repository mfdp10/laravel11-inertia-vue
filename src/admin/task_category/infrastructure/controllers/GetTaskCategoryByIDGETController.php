<?php

namespace Src\admin\task_category\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\task_category\application\GetTaskCategoryByIDUseCase;
use Src\admin\task_category\infrastructure\repositories\EloquentTaskCategoryRepository;
use Illuminate\Http\JsonResponse;

class GetTaskCategoryByIDGETController extends Controller
{
    public function index($id): JsonResponse
    {
        $use_case = new GetTaskCategoryByIDUseCase(new EloquentTaskCategoryRepository());
        return response()->json($use_case($id));
    }
}
