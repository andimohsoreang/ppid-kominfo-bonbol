<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiPubliksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_publiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('klasifikasi',['Serta Merta','Tersedia Setiap Saat','Berkala']);
            $table->string('judul');
            $table->string('ringkasan');
            $table->string('file');
            $table->string('filesize');
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
        Schema::dropIfExists('informasi_publiks');
    }
}
