<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class CreateKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->unsignedBigInteger('penggunaId');
            $table->integer('kelurahanId');
            $table->timestamps();

            $table->unique('penggunaId');
            $table->unique('kelurahanId');
            $table->foreign('penggunaId')->references('id')->on('pengguna')->onDelete('restrict');
            $table->foreign('kelurahanId')->references('id')->on(new Expression('db_ppl_core.kelurahan'))->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelurahan');
    }
}
