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
        Schema::create('skp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('skp_mulai');
            $table->date('skp_selesai');
            $table->foreignId('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('atasan_id')->nullable();
            $table->foreign('atasan_id')->references('id')->on('pegawai')->default('null')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('user_uuid')->references('uuid')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('draft');
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
        Schema::dropIfExists('skp');
    }
};
