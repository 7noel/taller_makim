<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentControlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_controls', function(Blueprint $table)
		{
			$table->id();
			$table->bigInteger('document_type_id')->unsigned();
			$table->bigInteger('company_id')->unsigned();
			$table->string('series', 10);
			$table->bigInteger('number')->unsigned();
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
            $table->foreign('company_id')->references('id')->on('companies');
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
		Schema::dropIfExists('document_controls');
	}

}
