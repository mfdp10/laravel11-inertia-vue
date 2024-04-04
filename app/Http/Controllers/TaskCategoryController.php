<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\TaskCategoryRequest;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client;

class TaskCategoryController extends Controller
{
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
        $file_name = null;
        $file_url = null;

        if ($request->file("fileName")) {

            $url = Storage::disk('google')->put("task-categories", $request->file("fileName"));
            $file_name = str_replace("task-categories/", "", $url);
            $public_link = Storage::disk('google')->url("task-categories/" . $file_name);

            $file_url = str_replace(
                "https://drive.google.com/uc",
                "https://drive.google.com/thumbnail",
                $public_link
            );
        }

        $taskCategory = TaskCategory::create(
            [
                'name' => $request->name,
                "image_name" => $file_name,
                'is_active' => $request->is_active,
            ]
        );

        if ($file_name) {
            $taskCategory->image()->create(["url" => $file_url]);
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
        $file_name = null;
        $file_url = null;
        $is_new_image = false;

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {

                Storage::disk('google')->delete("task-categories/" . $request->image_name);

                $url = Storage::disk('google')->put("task-categories", $request->file("fileName"));
                $file_name = str_replace("task-categories/", "", $url);
                $public_link = Storage::disk('google')->url("task-categories/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
            } else {
                $url = Storage::disk('google')->put("task-categories", $request->file("fileName"));
                $file_name = str_replace("task-categories/", "", $url);
                $public_link = Storage::disk('google')->url("task-categories/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
                $is_new_image = true;
            }
        } else {
            if (!$request->get("filePreview")) { //delete existing image
                if ($request->get("prev_image")) {
                    Storage::disk('google')->delete("task-categories/" . $request->image_name);
                    $taskCategory->image()->delete(["url" => $request->image_name]);
                }
            }
        }

        $taskCategory->update(
            [
                'name' => $request->name,
                "image_name" => $file_name,
                'is_active' => $request->is_active,
            ]
        );

        if ($file_name) {
            if ($is_new_image) {
                $taskCategory->image()->create(["url" => $file_url]);
            } else {
                $taskCategory->image()->update(["url" => $file_url]);
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
