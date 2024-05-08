<?php

namespace Src\admin\task_category\application;

use Src\admin\task_category\domain\contracts\TaskCategoryRepositoryContract;

final class GetTaskCategoryByIDUseCase
{
    private TaskCategoryRepositoryContract $repository;
    function __construct(TaskCategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    function __invoke($id)
    {
        return  $this->repository->getByID($id);
    }
}
