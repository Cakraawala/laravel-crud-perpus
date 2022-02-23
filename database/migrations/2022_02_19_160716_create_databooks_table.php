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
        Schema::create('databook', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categorybook_id')->index();
            $table->foreign('categorybook_id')->references('id')->on('categorybook');
            $table->unsignedBigInteger('penerbit_id')->index();
            $table->foreign('penerbit_id')->references('id')->on('penerbit');
            $table->string('judul');
            $table->string('pengarang');
            $table->year('tahun_terbit');
            $table->bigInteger('jumlah');
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
        Schema::dropIfExists('databook');
    }
};



