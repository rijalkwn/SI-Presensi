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
        Schema::create('rekap_presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('status_kepegawaian');
            $table->integer('hadir_tepat_waktu');
            $table->integer('hadir_terlambat');
            $table->integer('izin');
            $table->integer('sakit');
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
        Schema::dropIfExists('rekap_presensis');
    }
};
