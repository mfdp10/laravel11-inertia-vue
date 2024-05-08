<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/us', function () {
//     return response()->json("hola");
// });

Route::prefix('task_categories')->group(base_path('src/admin/task_category/infrastructure/routes/api.php'));
