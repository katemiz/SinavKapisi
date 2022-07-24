<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harun', function (Blueprint $table) {
            $table->id();
            $table->date('sinav_tarihi');
            $table->integer('tur_dogru');
            $table->integer('tur_yanlis');
            $table->integer('sos_dogru');
            $table->integer('sos_yanlis');
            $table->integer('mat_dogru');
            $table->integer('mat_yanlis');
            $table->integer('fen_dogru');
            $table->integer('fen_yanlis');
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
        Schema::dropIfExists('harun');
    }
};
