<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsendetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_details', function (Blueprint $table) {
            $table->id('absen_detail_id');
            $table->unsignedBigInteger('absensi_id');
            $table->unsignedBigInteger('anggota_id');
            $table->string('absen_status');
            $table->string('absen_note')->nullable();

            $table->foreign('anggota_id')->references('anggota_id')->on('anggotas')->onDelete('cascade');
            $table->foreign('absensi_id')->references('absensi_id')->on('absensis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_details');
    }
}
