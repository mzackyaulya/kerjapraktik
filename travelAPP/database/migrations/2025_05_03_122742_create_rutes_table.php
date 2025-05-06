<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rutes', function (Blueprint $table) {
            $table->uuid('id')-> primary();
            $table->string('asal');
            $table->string('tujuan');
            $table->string('metode');
            $table->integer('harga');
            $table->string('estimasi_waktu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rutes');
    }
};
