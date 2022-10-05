<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJumlahPenerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jumlah_penerima', function (Blueprint $table) {
            $table->id("id_jumlahPenerima");
            $table->date('tanggal');
            $table->Integer('jumlah');
            $table->unsignedBigInteger('id_tipe');
            $table->foreign('id_tipe')->references('id_tipe')->on('tipe_vaksin');
            $table->unsignedBigInteger('id_penerima');
            $table->foreign('id_penerima')->references('id_penerima')->on('penerima_vaksin');
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
        Schema::dropIfExists('jumlah_penerima');
    }
}
