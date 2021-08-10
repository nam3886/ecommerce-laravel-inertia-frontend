<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('stock');
            $table->enum('unit', ['percent', 'currency'])->default('percent');
            $table->json('products_id');
            $table->string('code')->unique();
            $table->text('description');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->boolean('valid')->default(true);
            $table->unsignedBigInteger('updated_by');
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
        Schema::dropIfExists('vouchers');
    }
}
