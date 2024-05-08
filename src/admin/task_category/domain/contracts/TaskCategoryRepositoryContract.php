<?php

namespace Src\admin\task_category\domain\contracts;

use Src\admin\task_category\domain\entities\TaskCategory;

interface TaskCategoryRepositoryContract
{
    public function all();
    public function getByID($task_category_id);
    public function save(TaskCategory $task_category): void;
    public function update(TaskCategory $task_category, int $id): void;
    public function delete($task_category_id): void;
}
