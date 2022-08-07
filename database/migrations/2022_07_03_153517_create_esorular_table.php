<?php

use App\Models\KapsamDal;
use App\Models\KapsamDers;
use App\Models\KapsamSinav;
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
        Schema::create('esorular', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(KapsamSinav::class);
            $table->foreignIdFor(KapsamDal::class)->nullable();
            $table->foreignIdFor(KapsamDers::class)->nullable();
            $table->text('soru_background');
            $table->text('soru');
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('esorular');
    }
};
