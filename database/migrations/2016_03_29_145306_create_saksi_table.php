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
            $table->string('token');
            $table->timestamp('waktuBuat')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->timestamp('waktuUpdate')->default(new Expression('CURRENT_TIMESTAMP'));

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
