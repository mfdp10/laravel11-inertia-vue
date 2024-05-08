<?php

namespace Src\admin\task_category\infrastructure\repositories;

use App\Models\TaskCategory as TaskCategoryEloquent;
use Src\admin\task_category\domain\value_objects\IsActive;
use Src\admin\task_category\domain\entities\TaskCategory;
use Src\admin\task_category\domain\contracts\TaskCategoryRepositoryContract;
use Src\admin\shared\domain\value_objects\TaskCategoryID;
use Src\admin\task_category\domain\value_objects\ImageName;
use Src\admin\task_category\domain\value_objects\Name;

final class EloquentTaskCategoryRepository implements TaskCategoryRepositoryContract
{
    public function all()
    {
        return TaskCategoryEloquent::all();
    }

    public function getByID($task_category_id)
    {
        $task_categoryEloquent = TaskCategoryEloquent::where('id', $task_category_id)->first();

        if (null === $task_categoryEloquent) {
            return null;
        }
        return $task_categoryEloquent;
        // return new TaskCategory(
        //     new TaskCategoryID($task_categoryEloquent->task_category_id),
        //     new Name($task_categoryEloquent->name),
        //     new ImageName($task_categoryEloquent->image_name || ""),
        //     new IsActive($task_categoryEloquent->is_active->toString()),
        // );
    }

    public function save(TaskCategory $task_category): void
    {
        $task_categoryEloquent = new TaskCategoryEloquent();
        $task_categoryEloquent->name = $task_category->getName();
        $task_categoryEloquent->image_name = $task_category->getImageName();
        $task_categoryEloquent->is_active = $task_category->getIsActive();
        $task_categoryEloquent->save();

        if ($task_category->getImageName() != "") {
            $task_categoryEloquent->image()->create(["url" => $task_category->getURL()]);
        }
    }

    public function update(TaskCategory $task_category, int $id): void
    {
        $task = TaskCategoryEloquent::where('id', $id)->first();

        if ($task !== null) {

            $task->name = $task_category->getName();
            $task->image_name = $task_category->getImageName();
            $task->is_active = $task_category->getIsActive();
            $task->update();

            if ($task_category->getOnlyDelete() !== "yes") {
                $task->image()->delete(["url" => $task_category->getURL()]);
            }

            if ($task_category->getImageName() !== "") {
                if ($task_category->getNewImage() === "yes") {
                    $task->image()->create(["url" => $task_category->getURL()]);
                } else {
                    $task->image()->update(["url" => $task_category->getURL()]);
                }
            }
        }
    }

    public function delete($task_category_id): void
    {
        TaskCategoryEloquent::where('id', $task_category_id)->delete();
    }
}
