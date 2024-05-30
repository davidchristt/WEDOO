<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->char('id_venue', 36)->primary();
            $table->char('id_gedung', 36);
            $table->string('alamat');
            $table->integer('biaya');
            $table->string('tipe');
            $table->text('deskripsi')->nullable();
            $table->string('kota');
            $table->timestamps();

            $table->foreign('id_gedung')->references('id_gedung')->on('gedungs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('venues');
    }
}
