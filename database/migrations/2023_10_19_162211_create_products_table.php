<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('trademark_id')->nullable();
            $table->foreign('trademark_id')->references('id')->on('trademarks')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('product_no', 255)->nullable();
            $table->string('name', 255);
            $table->string('image', 255);
            $table->bigInteger('price')->default(0)->nullable();
            $table->bigInteger('number')->default(0)->nullable();
            $table->bigInteger('selling')->default(0)->nullable();
            $table->text('contents')->nullable();

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
        Schema::dropIfExists('products');
    }
}
