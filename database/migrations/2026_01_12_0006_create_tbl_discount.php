<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('tbl_product')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_discount');
    }
};
