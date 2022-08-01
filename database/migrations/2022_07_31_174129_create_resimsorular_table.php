<?php

use App\Models\KapsamDal;
use App\Models\KapsamDers;
use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resimsorular', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class);
            $table->integer('soruno');
            $table->string('dogrusecenek')->nullable();
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
        Schema::dropIfExists('resimsorular');
    }
};
