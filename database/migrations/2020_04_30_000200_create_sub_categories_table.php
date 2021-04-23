<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_categories', function(Blueprint $table)
		{
			$table->id();
			$table->string('name');
			$table->string('description');
			$table->bigInteger('category_id')->unsigned();
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
			$table->foreign('category_id')->references('id')->on('categories');
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
		Schema::dropIfExists('sub_categories');
	}

}
