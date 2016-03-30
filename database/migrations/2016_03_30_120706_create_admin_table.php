<?php

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->unsignedBigInteger('penggunaId');
            $table->string('pegawaiId', 20);
            $table->timestamps();

            $table->unique('penggunaId');
            $table->unique('pegawaiId');
            $table->foreign('penggunaId')->references('id')->on('pengguna')->onDelete('restrict');
            $table->foreign('pegawaiId')->references('nip')->on(new Expression('db_ppl_core.pegawai'))->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin');
    }
}
