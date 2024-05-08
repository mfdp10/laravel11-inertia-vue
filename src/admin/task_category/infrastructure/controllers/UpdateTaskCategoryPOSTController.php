<?php

namespace Src\admin\task_category\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCategoryRequest;
use Src\admin\task_category\application\UpdateTaskCategoryUseCase;
use Src\admin\task_category\infrastructure\repositories\EloquentTaskCategoryRepository;
use Illuminate\Http\JsonResponse;

class UpdateTaskCategoryPOSTController extends Controller
{
    public function index(TaskCategoryRequest $task_category, int $id): JsonResponse
    {
        $use_case = new UpdateTaskCategoryUseCase(new EloquentTaskCategoryRepository());
        return response()->json($use_case($task_category, $id));
    }
}
