<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatVaksinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_vaksin', function (Blueprint $table) {
            $table->id("id_tempatVaksin");
            $table->string("nama_tempatVaksin");
            $table->longtext("alamat");
            $table->string("fasilitas");
            $table->string("posisi");
            $table->string("foto");
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatan');
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
        Schema::dropIfExists('tempat_vaksin');
    }
}
