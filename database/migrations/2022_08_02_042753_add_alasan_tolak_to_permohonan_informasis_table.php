<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlasanTolakToPermohonanInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan_informasis', function (Blueprint $table) {
            $table->text('alasan_tolak')->nullable();
            $table->foreignId('petugas_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan_informasis', function (Blueprint $table) {
            //
        });
    }
}
