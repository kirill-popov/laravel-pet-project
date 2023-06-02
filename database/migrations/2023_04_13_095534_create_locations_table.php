<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->string('name');
            $table->boolean('is_enabled')->default(false);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('zip');
            $table->unsignedBigInteger('prefecture_id')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->time('business_hours_start')->nullable();
            $table->time('business_hours_end')->nullable();
            $table->boolean('workday_mon')->default(false);
            $table->boolean('workday_tue')->default(false);
            $table->boolean('workday_wed')->default(false);
            $table->boolean('workday_thu')->default(false);
            $table->boolean('workday_fri')->default(false);
            $table->boolean('workday_sat')->default(false);
            $table->boolean('workday_sun')->default(false);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->cascadeOnDelete();
            $table->foreign('prefecture_id')->references('id')->on('prefectures')->nullOnDelete();
            $table->unique('name', 'unique_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
