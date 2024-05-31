<?php

// database/migrations/xxxx_xx_xx_create_vendors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->char('id_vendor', 36)->primary();
            $table->char('id_venue', 36);
            $table->char('id_souvenir', 36);
            $table->char('id_penghulu', 36);
            $table->char('id_mc', 36);
            $table->char('id_mobil', 36);
            $table->char('id_akomodasi', 36);
            $table->char('id_dokumentasi', 36);
            $table->char('id_catering', 36);
            $table->char('id_entertainment', 36);
            $table->char('id_perias', 36);
            $table->timestamps();

            $table->foreign('id_venue')->references('id_venue')->on('venues');
            $table->foreign('id_souvenir')->references('id_souvenir')->on('souvenirs')->onDelete('cascade');
            $table->foreign('id_penghulu')->references('id_penghulu')->on('penghulus')->onDelete('cascade');
            $table->foreign('id_mc')->references('id_mc')->on('mcs')->onDelete('cascade');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('cascade');;
            $table->foreign('id_akomodasi')->references('id_akomodasi')->on('akomodasis')->onDelete('cascade');
            $table->foreign('id_dokumentasi')->references('id_dokumentasi')->on('dokumentasis')->onDelete('cascade');
            $table->foreign('id_catering')->references('id_catering')->on('caterings')->onDelete('cascade');
            $table->foreign('id_entertainment')->references('id_entertainment')->on('entertainments')->onDelete('cascade');
            $table->foreign('id_perias')->references('id_perias')->on('perias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}