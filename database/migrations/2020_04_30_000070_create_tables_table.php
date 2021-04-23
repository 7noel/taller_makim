<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tables', function(Blueprint $table)
		{
			$table->id();
            $table->string('type');
            $table->bigInteger('my_company')->unsigned();
			$table->string('name');
			$table->string('description');
			$table->string('symbol');
			$table->string('code');
			$table->string('value_1');
			$table->string('value_2');
			$table->string('value_3');
            $table->bigInteger('relation_id')->unsigned();
            $table->bigInteger('table_id')->unsigned();
            $table->string('table_type');

			$table->timestamps();
			$table->softDeletes();

			$table->index(['type', 'my_company', 'name']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tables');
	}

}
