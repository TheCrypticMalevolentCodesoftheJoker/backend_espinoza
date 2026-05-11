<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('tbl_rol')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('password');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
