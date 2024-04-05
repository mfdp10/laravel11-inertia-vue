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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("first_name", 50)->nullable();
            $table->string("last_name", 50)->nullable();
            $table->string("company", 150)->nullable();
            $table->string("phone", 30)->nullable();
            $table->string("mobile", 30)->nullable();
            $table->string("id_card", 10)->nullable();
            $table->string("email", 80)->nullable();
            $table->string("comments", 255)->nullable();
            $table->string("image_name", 100)->nullable();
            $table->string("is_active", 3)->default(IsActiveEnum::YES->value);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
