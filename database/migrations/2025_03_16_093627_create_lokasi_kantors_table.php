<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('lokasi_kantors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kantor');
            $table->string('alamat');
            $table->double('latitude');
            $table->double('longitude');
            $table->double('radius')->default(100); // radius dalam meter
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('lokasi_kantors');
    }
};
