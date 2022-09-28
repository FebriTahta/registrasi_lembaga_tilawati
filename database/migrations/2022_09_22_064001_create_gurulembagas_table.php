<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurulembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurulembagas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembagasurvey_id');
            $table->string('nama_guru');
            $table->longText('alamat_guru')->nullable();
            $table->string('tempat_lahir_guru')->nullable();
            $table->string('tanggal_lahir_guru')->nullable();
            $table->string('telp_guru')->nullable();
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
        Schema::dropIfExists('gurulembagas');
    }
}
