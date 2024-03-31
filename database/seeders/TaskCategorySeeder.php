<?php

namespace Database\Seeders;

use App\Models\TaskCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskCategory::create([
            "name" => "Antenas"
        ]);
        TaskCategory::create([
            "name" => "Porteros"
        ]);
        TaskCategory::create([
            "name" => "Fibra"
        ]);
    }
}
