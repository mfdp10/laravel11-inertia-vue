<?php

namespace Src\admin\task_category\application;

use App\Enums\IsActiveEnum;
use App\Http\Requests\TaskCategoryRequest;
use Src\admin\shared\domain\value_objects\TaskCategoryID;
use Src\admin\task_category\domain\entities\TaskCategory;
use Src\admin\task_category\domain\contracts\TaskCategoryRepositoryContract;
use Src\admin\task_category\domain\value_objects\IsActive;
use Src\admin\task_category\domain\value_objects\ImageName;
use Src\admin\task_category\domain\value_objects\Name;
use App\Traits\GoogleDriveImageUpload;

class UpdateTaskCategoryUseCase
{
    use GoogleDriveImageUpload;

    private TaskCategoryRepositoryContract $repository;

    function __construct(TaskCategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    function __invoke(TaskCategoryRequest $task_category, int $id)
    {
        $onlyDelete = "no";
        $avatar = $this->upload($task_category, 'fileName', 'task-categories', $task_category->image_name);
        if (!$task_category->get("filePreview")) { //delete existing image
            if ($task_category->get("prev_image")) {
                $this->delete($task_category, 'task-categories');
                $onlyDelete = "yes";
            }
        }

        $new = new TaskCategory(new TaskCategoryID(0), new Name($task_category->name), new ImageName($avatar["image_name"]), new IsActive($task_category->is_active), $avatar["image_url"], $avatar["new_image"], $onlyDelete);

        $this->repository->update($new, $id);
        return true;
    }
}
