<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['failed', 'canceled', 'pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);

            $table->enum('payment_method', ['online', 'cash_on_delivery', 'DBBL Mobile Banking', 'BKash Mobile Banking', 'Islami Bank Bangladesh Limited', 'AB Bank Limited', 'CITY BANK, LTD.', 'Mutual Trust Banking Limited', 'Bank Asia Limited', 'TRUST BANK, LTD.', 'STANDARD CHARTERED BANK', 'QCASH'])->default('cash_on_delivery');
            $table->string('transection_id')->nullable();
            $table->string('store_id')->nullable();

            $table->string('shipping_fullname');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zipcode');
            $table->string('shipping_phone');
            $table->string('notes')->nullable();

            $table->string('billing_fullname');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zipcode');
            $table->string('billing_phone');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
