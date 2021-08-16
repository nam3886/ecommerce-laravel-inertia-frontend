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
            $table->string('order_code')->unique()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedInteger('items_count');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('discount_price');
            $table->unsignedInteger('tax_price');
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('grandtotal'); // exclude delivery fee
            $table->unsignedInteger('order_total'); // include delivery fee

            // $table->unsignedFloat('exchange_rate')->default(1);
            // $table->json('exchange_currency');

            $table->boolean('is_paid')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('bank_tran_number')->nullable();
            $table->string('bank_code')->nullable();

            // 0: unprocessed
            // 1: success => order created
            // 2: canceled => order not created yet
            // need it because billing for third party api sometimes crashes
            $table->unsignedTinyInteger('create_order_success')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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
