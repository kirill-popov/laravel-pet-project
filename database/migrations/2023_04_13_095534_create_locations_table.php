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
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedTinyInteger('status')->default(1);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('zip');
            $table->foreignId('prefecture_id')->nullable()->constrained()->nullOnDelete();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->time('business_hours_start');
            $table->time('business_hours_end');
            $table->unsignedTinyInteger('workday_0');
            $table->unsignedTinyInteger('workday_1');
            $table->unsignedTinyInteger('workday_2');
            $table->unsignedTinyInteger('workday_3');
            $table->unsignedTinyInteger('workday_4');
            $table->unsignedTinyInteger('workday_5');
            $table->unsignedTinyInteger('workday_6');
            $table->string('description');
            $table->timestamps();

            $table->index('prefecture_id');
            $table->unique('name', 'unique_name');
            $table->unique('email', 'unique_email');
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
