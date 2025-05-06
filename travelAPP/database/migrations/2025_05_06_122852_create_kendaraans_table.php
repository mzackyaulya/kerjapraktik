<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->uuid('id')-> primary();
            $table->string('noplat');
            $table->string('merk_mobil');
            $table->string('warna');
            $table->string('kapasitas');
            $table->enum('status',['Ready', 'Perbaikan'])->default('Ready');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
};
