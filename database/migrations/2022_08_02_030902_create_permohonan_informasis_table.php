<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_informasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('rincian');
            $table->text('tujuan');
            $table->enum('mendapat', ['Soft Copy', 'Hard Copy']);
            $table->enum('cara', ['Mengambil Langsung', 'Online By System']);
            $table->boolean('status');
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
        Schema::dropIfExists('permohonan_informasis');
    }
}
