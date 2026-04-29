<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Menggunakan 'nama' sesuai request
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'kepala_sekolah']);
            $table->timestamps();
        });

       
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
