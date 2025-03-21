<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->string('name');
            $table->enum('leave_type', ['cuti', 'izin', 'sakit']);
            $table->string('start_date');
            $table->string('end_date');
            $table->string('file');
            $table->text('reason');
            $table->enum('status', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('leave_requests');
    }
};
