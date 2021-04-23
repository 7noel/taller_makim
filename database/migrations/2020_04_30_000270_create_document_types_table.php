<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_types', function(Blueprint $table)
		{
			$table->id();
			$table->string('name');
			$table->string('code', 10);
			$table->string('description');
			$table->boolean('to_sales');
			$table->boolean('to_purchases');
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
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
		Schema::dropIfExists('document_types');
	}

}
