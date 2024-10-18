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
            $table->integer('total_amount')->default(0);
            $table->bigInteger('user_id');
            $table->timestamp('order_date');
            $table->bigInteger('coupon_id');
            $table->string('order_status');
            $table->string('shipment_status');
            $table->bigInteger('rating_id')->nullable();
            $table->string('payment_method');
            $table->bigInteger('address_id');
            $table->bigInteger('payment_id')->nullable();
            $table->integer('coupon_discount_amount')->default(0);
            $table->text('note')->nullable();
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
