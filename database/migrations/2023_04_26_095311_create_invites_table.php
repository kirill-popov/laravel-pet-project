<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('token');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->timestamps();

            $table->unique('email');
            $table->index(["id", "token"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
