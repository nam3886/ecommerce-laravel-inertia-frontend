<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->unique();
            $table->string('name');
            $table->unsignedBigInteger('price')->nullable();
            $table->string('description');
            $table->unsignedBigInteger('updated_by');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('delivery_methods');
    }
}
