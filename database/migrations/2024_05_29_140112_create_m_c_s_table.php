<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcsTable extends Migration
{
    public function up()
    {
        Schema::create('mcs', function (Blueprint $table) {
            $table->char('id_mc', 10)->primary();
            $table->string('nama');
            $table->string('kontak');
            $table->decimal('biaya', 10, 2);
            $table->string('ketersediaan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mcs');
    }
}
