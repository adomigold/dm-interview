<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('delivery_status');
            $table->string('delivery_address');
            $table->string('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Sales', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('product_id');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
            $table->dropColumn('delivery_status');
            $table->dropColumn('delivery_address');
            $table->dropColumn('reference');
        });
    }
};
