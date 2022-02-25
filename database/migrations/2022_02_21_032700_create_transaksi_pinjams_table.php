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
        Schema::create('transaksi_pinjam', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('user');
            $table->unsignedBigInteger('databook_id')->index();
            $table->foreign('databook_id')->references('id')->on('databook');
            $table->unsignedBigInteger('admin_id')->index();
            $table->foreign('admin_id')->references('id')->on('admin');
            $table->integer('jumlah');
            $table->dateTime('tanggal_pinjam')->default(now());
            $table->dateTime('tanggal_kembali');
            $table->string('status');
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
        Schema::dropIfExists('transaksi_pinjam');
    }
};
