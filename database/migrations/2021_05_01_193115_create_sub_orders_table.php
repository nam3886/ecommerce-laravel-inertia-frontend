<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('delivery_method_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('delivery_order_code')->unique()->index()->nullable();

            $table->enum('required_note', ['CHOTHUHANG', 'CHOXEMHANGKHONGTHU', 'KHONGCHOXEMHANG'])->default('KHONGCHOXEMHANG');
            $table->unsignedInteger('cod_amount')->nullable(); // tiền thu hộ
            $table->unsignedInteger('delivery_fee');

            $table->unsignedInteger('items_count');
            $table->unsignedInteger('discount_price');
            $table->unsignedInteger('tax_price');
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('total'); // exclude delivery fee
            $table->unsignedInteger('grandtotal'); // include delivery fee

            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

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
        Schema::dropIfExists('sub_orders');
    }
}