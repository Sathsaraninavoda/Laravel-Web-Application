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
        Schema::table('orders', function (Blueprint $table) {
            // Add missing columns to match Order model
            $table->datetime('order_date')->nullable()->after('customer_phone');
            $table->foreignId('customer_id')->nullable()->after('customer_email');
            $table->string('payment_method')->nullable()->after('status');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending')->after('payment_method');
            $table->text('shipping_address')->nullable()->after('payment_status');
            $table->text('billing_address')->nullable()->after('shipping_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_date',
                'customer_id', 
                'payment_method',
                'payment_status',
                'shipping_address',
                'billing_address'
            ]);
        });
    }
};
