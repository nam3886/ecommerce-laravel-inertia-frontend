<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->unique()->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->unique()->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('price');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->enum('unit', ['percent', 'currency'])->default('percent');
            $table->boolean('valid')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
