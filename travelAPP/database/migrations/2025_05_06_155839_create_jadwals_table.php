<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('rute_id')->constrained('rutes')->onDelete('cascade');
            $table->foreignUuid('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
            $table->foreignUuid('sopir_id')->constrained('sopirs')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};
