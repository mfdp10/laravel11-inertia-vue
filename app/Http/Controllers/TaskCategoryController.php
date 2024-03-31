<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\TaskCategoryRequest;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskCategoryController extends Controller
{
    public function index()
    {
        // $is_active = [];
        // foreach (IsActive::cases() as $value) {
        //     $is_active[$value->name] = __("is_active." . $value->value);
        // }
        //App::setlocale("es");
        //return __("is_active." . IsActive::YES->value);
        $task_categories = TaskCategory::with('image')->paginate(env("NUMBER_ITEMS_PER_PAGE"));
        return inertia("TaskCategories/Index", ["task_categories" => $task_categories]);
        //return inertia("TaskCategories/Index", ["task_categories" => $task_categories, "is_active" => $is_active]);
    }

    public function create()
    {
        $is_active_ops = IsActiveEnum::cases();
        return Inertia("TaskCategories/Create", ["is_active_ops" => $is_active_ops]);
    }

    public function store(TaskCategoryRequest $request)
    {
        // dd($request);

        $taskCategory = TaskCategory::create($request->validated());

        if ($request->file("fileName")) {
            $url = Storage::disk('public')->put("task-categories", $request->file("fileName"));

            $taskCategory->image()->create(["url" => $url]);
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
        //dd($request);
        $taskCategory->update($request->validated());

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {
                $old_image = str_replace("/storage", "", $request->get("prev_image"));
                Storage::disk('public')->delete($old_image);
                $url = Storage::disk('public')->put("task-categories", $request->file("fileName"));
                $taskCategory->image()->update(["url" => $url]);
            } else {
                $url = Storage::disk('public')->put("task-categories", $request->file("fileName"));
                $taskCategory->image()->create(["url" => $url]);
            }
        } else {
            if (!$request->get("filePreview")) { //delete existing image
                if ($request->get("prev_image")) {
                    $old_image = str_replace("/storage", "", $request->get("prev_image"));
                    Storage::disk('public')->delete($old_image);
                    $taskCategory->image()->delete(["url" => $request->get("prev_image")]);
                }
            }
        }

        return redirect()->route("task-categories.index");
    }

    public function destroy(TaskCategory $taskCategory)
    {
        $img = TaskCategory::with('image')->find($taskCategory->id);
        if ($img->image) {
            Storage::disk('public')->delete($img->image->url);
            $taskCategory->image()->delete(["url" => $img->image->url]);
        }
        $taskCategory->delete();

        return redirect()->route("task-categories.index");
    }
}
