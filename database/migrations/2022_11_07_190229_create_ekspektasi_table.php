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
        Schema::create('ekspektasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis');
            $table->string('prilaku')->nullable();
            $table->string('ekspektasi_atasan')->nullable();
            $table->string('ekspektasi_feedback')->nullable();
            $table->foreignUuid('skp_id')->references('id')->on('skp')->onDelete('CASCADE');
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
        Schema::dropIfExists('ekspektasi');
    }
};
