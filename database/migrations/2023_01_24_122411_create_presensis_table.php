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
            $table->string('nip')->unique();
            $table->string('nama');
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->string('keterangan');
            $table->string('status');
            $table->string('foto')->nullable();
            $table->string('latitude_masuk');
            $table->string('longitude_masuk');
            $table->string('latitude_keluar')->nullable();
            $table->string('longitude_keluar')->nullable();
            $table->foreign('nip')->references('nip')->on('users')->onDelete('cascade');
            $table->string('jabatan')->references('nama_jabatan')->on('jabatans')->onDelete('cascade');
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
