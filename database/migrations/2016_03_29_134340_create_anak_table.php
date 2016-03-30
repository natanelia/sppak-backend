<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->enum('jenisKelamin', ['pria', 'wanita']);
            $table->string('tempatLahir');
            $table->dateTime('waktuLahir');
            $table->string('jenisLahir');
            $table->integer('anakKe');
            $table->string('penolongKelahiran');
            $table->integer('berat');
            $table->integer('panjang');

            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anak');
    }
}
