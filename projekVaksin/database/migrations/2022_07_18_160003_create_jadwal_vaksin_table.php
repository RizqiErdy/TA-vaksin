<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalVaksinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_vaksin', function (Blueprint $table) {
            $table->id("id_jadwalVaksin");
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('jenis_vaksin');
            $table->string('tipe_vaksin');
            $table->unsignedBigInteger('id_tempatVaksin');
            $table->foreign('id_tempatVaksin')->references('id_tempatVaksin')->on('tempat_vaksin');
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
        Schema::dropIfExists('jadwal_vaksin');
    }
}
