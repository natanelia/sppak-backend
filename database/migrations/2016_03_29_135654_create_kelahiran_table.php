<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class CreateKelahiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelahiran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anakId');
            $table->integer('kelurahanId')->nullable();
            $table->unsignedBigInteger('instansiKesehatanId')->nullable();
            $table->string('kartuKeluargaId', 16)->nullable();
            $table->string('aktaNikahId')->nullable();
            $table->string('ibuId', 16)->nullable();
            $table->string('ayahId', 16)->nullable();
            $table->unsignedBigInteger('saksiSatuId')->nullable();
            $table->unsignedBigInteger('saksiDuaId')->nullable();
            $table->string('pemohonId', 16);
            $table->boolean('status')->default(false);
            $table->boolean('verifikasiSaksi1')->default(false);
            $table->boolean('verifikasiSaksi2')->default(false);
            $table->boolean('verifikasiInstansiKesehatan')->default(false);
            $table->boolean('verifikasiLurah')->default(false);
            $table->boolean('verifikasiAdmin')->default(false);
            $table->timestamp('waktuCetakTerakhir')->default(new Expression('null'));
            $table->timestamps();

            $table->unique('anakId');
            $table->foreign('anakId')->references('id')->on('anak')->onDelete('restrict');
            $table->foreign('kelurahanId')->references('id')->on(new Expression('db_ppl_core.kelurahan'))->onDelete('restrict');
            $table->foreign('instansiKesehatanId')->references('id')->on('instansiKesehatan')->onDelete('restrict');
            $table->foreign('kartuKeluargaId')->references('id')->on(new Expression('db_ppl_core.keluarga'))->onDelete('restrict');
            // $table->foreign('aktaNikahId')->references('id')->on(new Expression('sppan.aktaNikah')->onDelete('restrict');
            $table->foreign('ibuId')->references('id')->on(new Expression('db_ppl_core.penduduk'))->onDelete('restrict');
            $table->foreign('ayahId')->references('id')->on(new Expression('db_ppl_core.penduduk'))->onDelete('restrict');
            $table->foreign('saksiSatuId')->references('id')->on('saksi')->onDelete('restrict');
            $table->foreign('saksiDuaId')->references('id')->on('saksi')->onDelete('restrict');
            $table->foreign('pemohonId')->references('id')->on(new Expression('db_ppl_core.penduduk'))->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelahiran');
    }
}
