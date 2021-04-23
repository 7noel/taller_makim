<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->id();
			$table->string('company_name');
			$table->string('brand_name');
			$table->string('name');
			$table->string('paternal_surname');
			$table->string('maternal_surname');
			$table->string('id_type');
			$table->string('doc');
			$table->string('country')->default('PE');
			$table->string('ubigeo_code');
			$table->string('address');
			$table->string('code');
			$table->string('phone');
			$table->string('mobile');
			$table->string('email');
			$table->string('email_1');
			$table->string('email_2');
			$table->string('contact');
			$table->string('comment');
			$table->date('birth')->nullable();
			$table->string('bank_bcp');
			$table->string('bank_other');
			$table->string('entity_type', 20)->default('clients');
			$table->bigInteger('job_id')->unsigned();
			$table->integer('gender');
			$table->bigInteger('user_id')->unsigned()->nullable();
			
			$table->bigInteger('currency_id')->unsigned()->default(1);
			$table->decimal('credit', 15, 2);
			$table->bigInteger('company_id')->unsigned();
			$table->bigInteger('my_company')->unsigned();

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
		Schema::dropIfExists('companies');
	}

}
