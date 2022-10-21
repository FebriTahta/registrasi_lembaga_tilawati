<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantrilembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santrilembagas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembagasurvey_id');
            $table->string('nama_santri');
            $table->string('tempat_lahir_santri')->nullable();
            $table->string('tanggal_lahir_santri')->nullable();
            $table->string('jenis_wali_santri')->nullable();
            $table->string('nama_wali_santri')->nullable();
            $table->string('telp_wali_santri')->nullable();
            $table->longText('alamat_santri')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('santrilembagas');
    }
}
