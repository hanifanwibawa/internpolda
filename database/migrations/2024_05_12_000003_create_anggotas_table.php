<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->bigIncrements('anggota_id');
            $table->unsignedBigInteger('satker_id');
            $table->string('anggota_name');
            $table->string('anggota_pangkat');
            $table->string('anggota_nrp');
            $table->string('anggota_bidang');
            $table->string('anggota_contact');
            $table->string('anggota_address');
            $table->string('anggota_jenis_kelamin');
            $table->timestamps();

            $table->foreign('satker_id')->references('satker_id')->on('satkers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggotas');
    }
}

