<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            "name" => "Pasivos"
        ]);
        ProductCategory::create([
            "name" => "Cables"
        ]);
        ProductCategory::create([
            "name" => "Electrónica"
        ]);
    }
}
