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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->date('tanggal');
            $table->string('status_kepegawaian');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('surat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->string('lat_masuk')->nullable();
            $table->string('long_masuk')->nullable();
            $table->string('lat_pulang')->nullable();
            $table->string('long_pulang')->nullable();
            $table->foreign('nik')->references('nik')->on('users')->onDelete('cascade');
            $table->foreign('status_kepegawaian')->references('status_kepegawaian')->on('kepegawaians')->onDelete('cascade');
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
        Schema::dropIfExists('presensis');
    }
};
