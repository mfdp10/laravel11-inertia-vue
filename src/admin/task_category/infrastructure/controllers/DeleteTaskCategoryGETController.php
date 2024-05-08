<?php

namespace Src\admin\task_category\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\task_category\application\DeleteTaskCategoryUseCase;
use Src\admin\task_category\infrastructure\repositories\EloquentTaskCategoryRepository;
use Illuminate\Http\JsonResponse;

class DeleteTaskCategoryGETController extends Controller
{
    public function index($id): JsonResponse
    {
        $use_case = new DeleteTaskCategoryUseCase(new EloquentTaskCategoryRepository());
        return response()->json($use_case($id));
    }
}
