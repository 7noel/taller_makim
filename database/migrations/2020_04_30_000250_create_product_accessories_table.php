<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_accessories', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity', 12 , 5)->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('accessory_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('accessory_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_accessories');
    }
}
