<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modelos', function(Blueprint $table)
		{
			$table->id('id');
			$table->string('name');
			$table->string('description');
			$table->bigInteger('brand_id')->unsigned();
            //$table->bigInteger('my_company')->unsigned();

			$table->foreign('brand_id')->references('id')->on('brands');
            //$table->foreign('my_company')->references('id')->on('companies');
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
		Schema::drop('modelos');
	}

}
