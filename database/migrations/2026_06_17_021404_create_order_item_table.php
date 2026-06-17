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
        Schema::create('orderItem', function (Blueprint $table) {
            $table->id('orderItemId');
            $table->foreignId('orderId')
                ->index('idx_orderItem_orderId')
                ->constrained(
                    table: 'orders',
                    column: 'orderId',
                    indexName: 'fk_orderItem_orders',
                )
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('itemId')
                ->index('idx_orderItem_itemId')
                ->constrained(
                    table: 'items',
                    column: 'itemId',
                    indexName: 'fk_orderItem_items',
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('qty', total: 15, places: 2)->default(0);
            $table->decimal('price', total: 15, places: 2)->default(0);
            $table->decimal('discAmount', total: 15, places: 2)->default(0);
            $table->decimal('totalItem', total: 15, places: 2)->default(0);

            $table->index(['orderId', 'itemId'], 'idx_orderItem_order_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderItem');
    }
};
