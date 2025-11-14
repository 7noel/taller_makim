<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned();
            $table->boolean('is_downloadable');
            $table->decimal('value',15,2);
            $table->decimal('price',15,2);
            $table->decimal('quantity',15,2);
            $table->decimal('discount',15,2);
            $table->decimal('d1',15,2);
            $table->decimal('d2',15,2);
            $table->decimal('total',15,2);
            $table->decimal('price_item',15,2);
            $table->text('comment');
            $table->text('description');
            $table->decimal('cost',15,2);
            $table->bigInteger('technician_id')->unsigned();
            $table->bigInteger('voucher_id')->unsigned();
            $table->string('provider');
            $table->string('guide_number');
            $table->string('status')->default('REGISTRADO');
            $table->dateTime('requested_at')->nullable();
            $table->dateTime('expected_at')->nullable();
            $table->dateTime('alert_at')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->json('data')->nullable();

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('unit_id')->references('id')->on('tables');
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
        Schema::dropIfExists('order_details');
    }
}
