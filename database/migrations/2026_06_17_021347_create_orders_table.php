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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderId');
            $table->string('orderNo', 30)->unique('uq_orders_orderNo');
            $table->date('orderDate')->index('idx_orders_orderDate');
            $table->foreignId('custId')
                ->index('idx_orders_custId')
                ->constrained(
                    table: 'customers',
                    column: 'custId',
                    indexName: 'fk_orders_customers',
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('subtotal', total: 15, places: 2)->default(0);
            $table->decimal('discAmount', total: 15, places: 2)->default(0);
            $table->decimal('netto', total: 15, places: 2)->default(0);
            $table->decimal('dpp', total: 15, places: 2)->default(0);
            $table->decimal('ppn', total: 15, places: 2)->default(0);
            $table->decimal('grandtotal', total: 15, places: 2)->default(0);

            $table->index(['custId', 'orderDate'], 'idx_orders_cust_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
