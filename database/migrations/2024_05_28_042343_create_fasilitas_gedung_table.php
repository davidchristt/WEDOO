<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_fasilitas_gedung_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasGedungTable extends Migration
{
    public function up()
    {
        Schema::create('fasilitas_gedung', function (Blueprint $table) {
            $table->id();
            $table->char('gedung_id', 36);
            $table->char('fasilitas_id', 36);
            $table->timestamps();

            $table->foreign('gedung_id')->references('id_gedung')->on('gedungs')->onDelete('cascade');
            $table->foreign('fasilitas_id')->references('id_fasilitas')->on('fasilitas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fasilitas_gedung');
    }
}