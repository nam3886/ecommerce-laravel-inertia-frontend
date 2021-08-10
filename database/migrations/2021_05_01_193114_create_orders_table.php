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
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('delivery_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('voucher_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('updated_by');
            $table->string('order_code')->unique()->index();
            $table->string('delivery_order_code')->unique()->index()->nullable();

            $table->unsignedInteger('items_count');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('discount_price');
            $table->unsignedInteger('tax_price');
            $table->unsignedInteger('sub_total');
            $table->unsignedInteger('grand_total'); // exclude delivery fee
            $table->unsignedInteger('order_total'); // include delivery fee
            $table->unsignedFloat('exchange_rate')->default(1);
            $table->json('exchange_currency');
            // 0: unprocessed
            // 1: success => order created
            // 2: canceled => order not created yet
            $table->unsignedTinyInteger('order_success')->default(0);
            $table->boolean('is_paid')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('bank_tran_number')->nullable();
            $table->string('bank_code')->nullable();

            $table->string('name');
            $table->string('phone');
            $table->unsignedInteger('delivery_service_id');
            $table->unsignedInteger('delivery_fee');
            $table->unsignedInteger('cod_amount')->nullable(); // tiền thu hộ
            $table->tinyInteger('person_pay_delivery_fee')->default(1);  // 1: Shop/Seller, 2: Buyer/Consignee.
            $table->string('address');
            $table->json('api_address');
            $table->string('note')->nullable();
            $table->enum('required_note', [
                'CHOTHUHANG',
                'CHOXEMHANGKHONGTHU',
                'KHONGCHOXEMHANG',
            ])->default('KHONGCHOXEMHANG');

            $table->string('status')->nullable();
            $table->boolean('active')->default(true);
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
