<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->json('image');
            $table->enum('position', ['slider', 'body1', 'body2', 'body3', 'bottom', 'other'])->default('other');
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->unsignedInteger('order')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
