<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGedungsTable extends Migration
{
    public function up()
    {
        Schema::create('gedungs', function (Blueprint $table) {
            $table->char('id_gedung', 36)->primary();
            $table->string('nama_gedung');
            $table->integer('luas');
            $table->integer('kapasitas');
            $table->integer('kapasitas_parkir');
            $table->string('link_denah')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gedungs');
    }
}

