<?php

use App\Enums\IsActiveEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->mediumText("description")->nullable();
            $table->string("summary")->nullable();
            $table->string("weight", 20)->nullable();
            $table->string("dimensions", 20)->nullable();
            $table->float("price");
            $table->string("is_active", 3)->default(IsActiveEnum::YES->value);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
