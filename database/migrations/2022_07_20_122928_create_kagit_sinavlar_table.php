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
        Schema::create('kagit_sinavlar', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(KapsamSinav::class);
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
        Schema::dropIfExists('kagit_sinavlar');
    }
};