<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->string('type', 3); // sm, md, lg, xl
            $table->string('link_to', 200);
            $table->string('title', 100)->nullable();
            $table->string('subtitle', 300)->nullable();
            $table->string('img_url', 200);
            $table->unsignedTinyInteger('img_only');

            $table->index('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tiles', function (Blueprint $table) {
            $table->dropForeign('tiles_shop_id_foreign');
        });

        Schema::dropIfExists('tiles');
    }
}
