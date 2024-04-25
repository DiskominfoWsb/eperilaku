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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Nama');
            $table->string('description')->default('Deskripsi');
            $table->string('alamat')->default('Alamat');
            $table->string('phone')->default('0123');
            $table->string('images')->default('logo.png');
            $table->string('logo')->default('logo.png');
            $table->string('frontend_background')->default('background.jpeg');
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
        Schema::dropIfExists('setting');
    }
};
