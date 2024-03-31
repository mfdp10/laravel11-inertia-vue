<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(["name" => "admin"]);
        $role_technician = Role::create(["name" => "technician"]);

        $permission_roles_index = Permission::create(["name" => "roles.index"]);
        $permission_roles_create = Permission::create(["name" => "roles.create"]);
        $permission_roles_edi = Permission::create(["name" => "roles.edit"]);
        $permission_roles_destroy = Permission::create(["name" => "roles.destroy"]);

        $permission_customers_index = Permission::create(["name" => "customers.index"]);
        $permission_customers_create = Permission::create(["name" => "customers.create"]);
        $permission_customers_edit = Permission::create(["name" => "customers.edit"]);
        $permission_customers_destroy = Permission::create(["name" => "customers.destroy"]);

        $permission_task_categories_index = Permission::create(["name" => "task-categories.index"]);
        $permission_task_categories_create = Permission::create(["name" => "task-categories.create"]);
        $permission_task_categories_edit = Permission::create(["name" => "task-categories.edit"]);
        $permission_task_categories_destroy = Permission::create(["name" => "task-categories.destroy"]);

        $permission_tasks_index = Permission::create(["name" => "tasks.index"]);
        $permission_tasks_create = Permission::create(["name" => "tasks.create"]);
        $permission_tasks_edit = Permission::create(["name" => "tasks.edit"]);
        $permission_tasks_destroy = Permission::create(["name" => "tasks.destroy"]);

        $permission_product_categories_index = Permission::create(["name" => "product-categories.index"]);
        $permission_product_categories_create = Permission::create(["name" => "product-categories.create"]);
        $permission_product_categories_edit = Permission::create(["name" => "product-categories.edit"]);
        $permission_product_categories_destroy = Permission::create(["name" => "product-categories.destroy"]);

        $permission_products_index = Permission::create(["name" => "products.index"]);
        $permission_products_create = Permission::create(["name" => "products.create"]);
        $permission_products_edit = Permission::create(["name" => "products.edit"]);
        $permission_products_destroy = Permission::create(["name" => "products.destroy"]);

        $permissions_admin = [
            $permission_roles_index, $permission_roles_create, $permission_roles_edi, $permission_roles_destroy,
            $permission_customers_index, $permission_customers_create, $permission_customers_edit, $permission_customers_destroy,
            $permission_task_categories_index, $permission_task_categories_create, $permission_task_categories_edit, $permission_task_categories_destroy,
            $permission_tasks_index, $permission_tasks_create, $permission_tasks_edit, $permission_tasks_destroy,
            $permission_product_categories_index, $permission_product_categories_create, $permission_product_categories_edit, $permission_product_categories_destroy,
            $permission_products_index, $permission_products_create, $permission_products_edit, $permission_products_destroy
        ];
        $permissions_technician = [
            $permission_task_categories_index, $permission_task_categories_create, $permission_task_categories_edit, $permission_task_categories_destroy,
            $permission_tasks_index, $permission_tasks_create, $permission_tasks_edit, $permission_tasks_destroy
        ];

        $role_admin->syncPermissions($permissions_admin);
        $role_technician->syncPermissions($permissions_technician);

        //to assign permissions individualy
        // $role_technician->givePermissionTo($permission_roles_index);//assign individial permission

    }
}
