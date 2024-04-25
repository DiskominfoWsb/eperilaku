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
        Schema::create('kinerja', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('jenis', ['UTAMA', 'TAMBAHAN'])->default('UTAMA');
            $table->foreignUuid('skp_id')->references('id')->on('skp')->onDelete('cascade')->onUpdate('cascade');
            $table->text('rencana_intervensi');
            $table->text('rencana');
            $table->text('aspek');
            $table->text('indikator');
            $table->text('target');
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
        Schema::dropIfExists('kinerja');
    }
};
