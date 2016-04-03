<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class CreateInstansiKesehatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansiKesehatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->enum('jenis', ['rumahSakit', 'klinik']);
            $table->string('alamat');
            $table->integer('kotaId');
            $table->timestamps();

            $table->index('nama');
            $table->unique('penggunaId');
            $table->foreign('penggunaId')->references('id')->on('pengguna')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instansiKesehatan');
    }
}
