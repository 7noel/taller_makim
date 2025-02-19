<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderChecklistDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_checklist_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('checklist_id')->unsigned();
            $table->bigInteger('checklist_detail_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('category');
            $table->string('status');
            $table->string('comment');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('checklist_id')->references('id')->on('checklists');
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
        Schema::dropIfExists('order_checklist_details');
    }
}
