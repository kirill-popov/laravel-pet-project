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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->string('stock_code');
            $table->string('description');
            $table->BigInteger('quantity');
            $table->dateTime('invoice_date');
            $table->unsignedDecimal('unit_price', $precision = 8, $scale = 2);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('country');
            $table->decimal('total_price', $precision = 8, $scale = 2)->default(0);
            $table->decimal('total_sum', $precision = 8, $scale = 2)->default(0);

            $table->index(['invoice_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
