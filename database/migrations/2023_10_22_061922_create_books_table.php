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
        Schema::create('books', function (Blueprint $table) {
            $table->id('idbuku');
            $table->string('isbn');
            $table->string('judul');
            $table->unsignedBigInteger('idkategori');
            // $table->foreign('idkategori')->references('idkategori')->on('categories');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('kota_terbit');
            $table->string('editor');
            $table->string('file_gambar');
            $table->timestamp('tgl_insert')->default(now());
            $table->timestamp('tgl_update')->nullable();
            $table->integer('stok');
            $table->integer('stok_tersedia');
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
        Schema::dropIfExists('books');
    }
};
