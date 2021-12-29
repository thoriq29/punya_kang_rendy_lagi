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
            $table->string('invoice');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('package_id');
            $table->decimal('price', 12, 2);
            $table->decimal('additional_fee', 10, 2)->default(0);
            $table->decimal('price_total', 12, 2);
            $table->integer('status')->default(100);
            $table->string('payment_type'); //(lumpsum\partial)
            $table->boolean('has_paid_off')->default(0);
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
