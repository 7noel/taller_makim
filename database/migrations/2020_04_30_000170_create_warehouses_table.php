<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('warehouses', function(Blueprint $table)
		{
			$table->id();
			$table->string('name');
			$table->string('address');
			$table->bigInteger('company_id')->unsigned();
			$table->bigInteger('provider_id')->unsigned();
			$table->string('ubigeo_code');
			$table->string('country')->default('PE');
			$table->string('phone');
			$table->string('mobile');
			$table->string('email');
			$table->string('contact');
			$table->string('comment');
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');;
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
		Schema::dropIfExists('warehouses');
	}

}
