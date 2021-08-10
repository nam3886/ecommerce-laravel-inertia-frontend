<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('link')->nullable();
            $table->enum('type', ['normal', '3_nestle'])->default('normal');
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
        Schema::dropIfExists('menus');
    }
}
