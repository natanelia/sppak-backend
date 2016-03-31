<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class CreateSaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pendudukId', 16);
            $table->string('email');
            $table->string('token');
            $table->timestamps();

            $table->foreign('pendudukId')->references('id')->on(new Expression('db_ppl_core.penduduk'))->onDelete('restrict');
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('saksi');
    }
}
