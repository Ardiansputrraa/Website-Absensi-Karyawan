<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('alpha');
            $table->foreignId('kantor_id')->constrained('lokasi_kantors');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('attendances');
    }
};
