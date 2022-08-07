<?php

use App\Models\KagitSinav;
use App\Models\KapsamDal;
use App\Models\KapsamDers;
use App\Models\User;
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(KagitSinav::class);
            $table->integer('sira');
            $table->string('mimetype');
            $table->string('filename');
            $table->string('stored_as');
            $table->integer('size');
            $table->foreignIdFor(KapsamDal::class)->nullable();
            $table->foreignIdFor(KapsamDers::class)->nullable();
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
        Schema::dropIfExists('pages');
    }
};
