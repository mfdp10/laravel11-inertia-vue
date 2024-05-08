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

class SaveTaskCategoryUseCase
{
    use GoogleDriveImageUpload;

    private TaskCategoryRepositoryContract $repository;

    function __construct(TaskCategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    function __invoke(TaskCategoryRequest $task_category)
    {
        $avatar = $this->upload($task_category, 'fileName', 'task-categories', $task_category->image_name);

        $new = new TaskCategory(new TaskCategoryID(0), new Name($task_category->name), new ImageName($avatar["new_image"]), new IsActive($task_category->is_active), $avatar["image_url"]);

        $this->repository->save($new);
        return true;
    }
}
