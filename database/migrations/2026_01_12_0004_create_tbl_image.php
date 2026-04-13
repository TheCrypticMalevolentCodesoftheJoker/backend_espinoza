<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('tbl_product')->onDelete('restrict');
            $table->string('url', 255);
            $table->string('type', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_image');
    }
};
