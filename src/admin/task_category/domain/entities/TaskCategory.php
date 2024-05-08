<?php

namespace Src\admin\task_category\domain\entities;

use Src\admin\shared\domain\value_objects\TaskCategoryID;
use Src\admin\task_category\domain\value_objects\Name;
use Src\admin\task_category\domain\value_objects\ImageName;
use Src\admin\task_category\domain\value_objects\IsActive;

final class TaskCategory
{
    private TaskCategoryID $task_category_id;
    private Name $name;
    private ImageName $image_name;
    private IsActive $is_active;
    private string $url;
    private string $new_image;
    private string $onlyDelete;

    function __construct(TaskCategoryID $task_category_id, Name $name, ImageName $image_name, IsActive $is_active, string $url, string $new_image = "", string $onlyDelete = "no")
    {
        $this->task_category_id = $task_category_id;
        $this->name = $name;
        $this->image_name = $image_name;
        $this->is_active = $is_active;
        $this->url = $url;
        $this->new_image = $new_image;
        $this->onlyDelete = $onlyDelete;
    }

    public function getTaskCategoryID(): int
    {
        return $this->task_category_id->value();
    }

    public function setTaskCategoryID(TaskCategoryID $task_category_id): void
    {
        $this->task_category_id = $task_category_id;
    }

    public function getName(): string
    {
        return $this->name->value();
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getImageName(): string
    {
        return $this->image_name->value();
    }

    public function setImageName(ImageName $image_name): void
    {
        $this->image_name = $image_name;
    }

    public function getIsActive(): string
    {
        return $this->is_active->value();
    }

    public function setIsActive(IsActive $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function getURL(): string
    {
        return $this->url;
    }

    public function setURL(string $url): void
    {
        $this->url = $url;
    }

    public function getNewImage(): string
    {
        return $this->new_image;
    }

    public function setNewImage(string $new_image): void
    {
        $this->new_image = $new_image;
    }

    public function getOnlyDelete(): string
    {
        return $this->onlyDelete;
    }

    public function setOnlyDelete(string $onlyDelete): void
    {
        $this->onlyDelete = $onlyDelete;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->task_category_id->value(),
            'name' => $this->name->value(),
            'image_name' => $this->image_name->value(),
            'is_active' => $this->is_active->value(),
        ];
    }
}
