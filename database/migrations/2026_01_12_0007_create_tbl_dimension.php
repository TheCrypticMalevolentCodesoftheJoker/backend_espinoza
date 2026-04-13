<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_dimension', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('tbl_product')->cascadeOnDelete();
            $table->string('length', 50);
            $table->string('width', 50);
            $table->string('thickness', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_dimension');
    }
};