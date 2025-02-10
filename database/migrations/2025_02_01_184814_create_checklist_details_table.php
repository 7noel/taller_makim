<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('category');
            $table->string('description');

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
        Schema::dropIfExists('checklist_details');
    }
}
