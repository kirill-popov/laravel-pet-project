<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30);
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->unsignedTinyInteger('status')->default(1);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('zip', 20);
            $table->foreignId('prefecture_id')->nullable()->constrained()->nullOnDelete();
            $table->string('address', 100);
            $table->string('address2', 100)->nullable();
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->time('business_hours_start');
            $table->time('business_hours_end');
            $table->string('description', 200);
            $table->timestamps();

            $table->index('prefecture_id');
            $table->unique('name', 'unique_name');
            $table->unique('email', 'unique_email');
        });

        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            // $table->enum('type', ['facebook', 'instagram', 'twitter', 'line', 'tiktok', 'youtube']);
            // $table->string('url', 200);
            $table->string('facebook', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('line', 200)->nullable();
            $table->string('tiktok', 200)->nullable();
            $table->string('youtube', 200)->nullable();

            $table->index('location_id');
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('default');
            $table->string('url', 100);

            $table->index('location_id');
        });

        Schema::create('workdays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('day');
            $table->unsignedTinyInteger('value');

            $table->index('location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign('locations_prefecture_id_foreign');
            $table->dropIndex('locations_prefecture_id_index');
        });

        Schema::table('socials', function (Blueprint $table) {
            $table->dropForeign('socials_location_id_foreign');
            $table->dropIndex('socials_location_id_index');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign('photos_location_id_foreign');
        });

        Schema::table('workdays', function (Blueprint $table) {
            $table->dropForeign('workdays_location_id_foreign');
        });

        Schema::dropIfExists('locations');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('prefectures');
        Schema::dropIfExists('socials');
        Schema::dropIfExists('workdays');
    }
}
