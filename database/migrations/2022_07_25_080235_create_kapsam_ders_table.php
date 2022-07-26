<?php

use App\Models\KapsamDal;
use App\Models\KapsamSinav;
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
        Schema::create('kapsam_ders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KapsamSinav::class);
            $table->foreignIdFor(KapsamDal::class)->nullable();
            $table->string('title');
            $table->string('abbr');
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
        Schema::dropIfExists('kapsam_ders');
    }
};
