<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('userable_id', 20);
            $table->enum('userable_type', ['MorphPenduduk', 'MorphKelurahan', 'MorphInstansiKesehatan', 'MorphPegawai']);
            $table->rememberToken();
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
        Schema::drop('pengguna');
    }
}
