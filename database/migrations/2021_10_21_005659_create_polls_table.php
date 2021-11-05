<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->decimal('p1', 3, 0);
            $table->decimal('p2', 3, 0);
            $table->decimal('p3', 3, 0);
            $table->decimal('p4', 3, 0);
            $table->decimal('p5', 3, 0);
            $table->decimal('p6', 3, 0);
            $table->decimal('p7', 3, 0);
            $table->decimal('p8', 3, 0);
            $table->decimal('p9', 3, 0);
            $table->decimal('p10', 3, 0);
            $table->decimal('isc', 5, 0);
            $table->text('comment');
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('polls');
    }
}
