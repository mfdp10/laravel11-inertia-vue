<?php

namespace Src\admin\task_category\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCategoryRequest;
use Src\admin\task_category\application\SaveTaskCategoryUseCase;
use Src\admin\task_category\infrastructure\repositories\EloquentTaskCategoryRepository;
use Illuminate\Http\JsonResponse;

class CreateTaskCategoryPOSTController extends Controller
{
    public function index(TaskCategoryRequest $task_category): JsonResponse
    {
        $use_case = new SaveTaskCategoryUseCase(new EloquentTaskCategoryRepository());
        return response()->json($use_case($task_category));
    }
}
