<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('image', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('phone_number', 100)->nullable();
            $table->string('position', 100);
            $table->string('role', 100);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pegawais');
    }
};
