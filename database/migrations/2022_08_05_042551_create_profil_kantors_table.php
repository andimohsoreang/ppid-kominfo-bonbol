<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilKantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_kantors', function (Blueprint $table) {
            $table->id();
            $table->text('tentang');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->string('fb');
            $table->string('ig');
            $table->string('tw');
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
        Schema::dropIfExists('profil_kantors');
    }
}
