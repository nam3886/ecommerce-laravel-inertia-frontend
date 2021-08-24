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
            // một đơn hàng chỉ có 1 phương thức vận chuyễn => sub order không cần delivery_method_id
            // $table->foreignId('delivery_method_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('delivery_order_code')->unique()->index()->nullable();

            $table->enum('required_note', ['CHOTHUHANG', 'CHOXEMHANGKHONGTHU', 'KHONGCHOXEMHANG'])->default('KHONGCHOXEMHANG');
            $table->unsignedInteger('cod_amount')->nullable(); // tiền thu hộ
            $table->unsignedInteger('shipping_fee');

            $table->unsignedInteger('items_count');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('tax');
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('total'); // exclude delivery fee
            $table->unsignedInteger('grandtotal'); // include delivery fee

            $table->string('note')->nullable();
            $table->string('status')->default('pending');
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
