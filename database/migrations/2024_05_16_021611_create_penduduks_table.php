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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->string('nama_penduduk', 255);
            $table->bigInteger('nik');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255);
            $table->integer('provinsi');
            $table->integer('kabupaten');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
};
