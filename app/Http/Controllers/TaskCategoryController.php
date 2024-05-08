<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\TaskCategoryRequest;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\Storage;
use App\Traits\GoogleDriveImageUpload;

class TaskCategoryController extends Controller
{
    use GoogleDriveImageUpload;

    public function index()
    {
        $task_categories = TaskCategory::with('image')->paginate(env("NUMBER_ITEMS_PER_PAGE"));
        return inertia("TaskCategories/Index", ["task_categories" => $task_categories]);
    }

    public function create()
    {
        $is_active_ops = IsActiveEnum::cases();
        return Inertia("TaskCategories/Create", ["is_active_ops" => $is_active_ops]);
    }

    public function store(TaskCategoryRequest $request)
    {

        $avatar = $this->upload($request, 'fileName', 'task-categories');

        $taskCategory = TaskCategory::create(
            [
                'name' => $request->name,
                "image_name" => $avatar["image_name"],
                'is_active' => $request->is_active,
            ]
        );

        if ($avatar["image_name"]) {
            $taskCategory->image()->create(["url" => $avatar["image_url"]]);
        }

        return redirect()->route("task-categories.index");
    }

    public function show(TaskCategory $taskCategory)
    {
        //
    }

    public function edit(TaskCategory $taskCategory)
    {
        $is_active_ops = IsActiveEnum::cases();
        return inertia("TaskCategories/Edit", ["task_category" => TaskCategory::with('image')->find($taskCategory->id), "is_active_ops" => $is_active_ops]);
    }

    public function update(TaskCategoryRequest $request, TaskCategory $taskCategory)
    {
        $avatar = $this->upload($request, 'fileName', 'task-categories', $request->image_name);

        if (!$request->get("filePreview")) { //delete existing image
            if ($request->get("prev_image")) {
                $this->delete($request, 'task-categories');
                $taskCategory->image()->delete(["url" => $request->image_name]);
            }
        }

        $taskCategory->update(
            [
                'name' => $request->name,
                "image_name" => $avatar["image_name"],
                'is_active' => $request->is_active,
            ]
        );

        if ($avatar["image_name"]) {
            if ($avatar["new_image"]) {
                $taskCategory->image()->create(["url" => $avatar["image_url"]]);
            } else {
                $taskCategory->image()->update(["url" => $avatar["image_url"]]);
            }
        }

        return redirect()->route("task-categories.index");
    }

    public function destroy(TaskCategory $taskCategory)
    {
        if ($taskCategory->image_name) {
            Storage::disk('google')->delete("task-categories/" . $taskCategory->image_name);
            $taskCategory->image()->delete(["url" => $taskCategory->image_name]);
        }
        $taskCategory->delete();

        return redirect()->route("task-categories.index");
    }
}
