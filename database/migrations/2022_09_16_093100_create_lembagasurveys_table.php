<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembagasurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembagasurveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akseslembaga_id');
            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->string('anggota')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('provinsi_id');
            $table->string('nama_lembaga');
            $table->string('alamat_lembaga');
            $table->string('telp_lembaga');
            $table->string('jenjang_pendidikan');
            $table->string('satuan_pendidikan');
            $table->string('bagian');
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
        Schema::dropIfExists('lembagasurveys');
    }
}
