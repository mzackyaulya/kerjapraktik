<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sopirs', function (Blueprint $table) {
            $table->uuid('id')-> primary();
            $table->string('nama');
            $table->string('nohp');
            $table->string('alamat');
            $table->string('nosim');
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sopirs');
    }
};
