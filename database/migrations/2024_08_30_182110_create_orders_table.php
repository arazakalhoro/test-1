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
            $table->id();
            $table->string('reference')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shipping_address_id');
            $table->unsignedBigInteger('billing_address_id');
            $table->unsignedBigInteger('order_status_id');
            $table->decimal('tax')->default(0.00);
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
            $table->foreign('shipping_address_id')
                ->references('id')
                ->on('customer_addresses');
            $table->foreign('billing_address_id')
                ->references('id')
                ->on('customer_addresses');
            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses');
            $table->timestamps();
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
