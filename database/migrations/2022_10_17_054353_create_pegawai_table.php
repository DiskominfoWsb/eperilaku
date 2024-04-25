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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18);
            $table->string('nama');
            $table->string('t_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jns_kelamin', ['L', 'P'])->default('L');
            $table->string('gelar_depan')->default('-');
            $table->string('gelar_belakang')->default('-');
            $table->foreignUuid('user_uuid')->references('uuid')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('golongan_uuid')->references('uuid')->on('golongan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jabatan')->nullable();
            $table->uuid('instansi')->nullable();
            $table->foreign('instansi')->references('id')->on('instansi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_telp')->nullable();
            $table->string('foto')->default('defaul.jpg');
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
        Schema::dropIfExists('pegawai');
    }
};
