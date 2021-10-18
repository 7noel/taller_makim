<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->id();
			$table->string('intern_code');
			$table->string('provider_code');
			$table->string('manufacturer_code');
			$table->string('name');
			$table->text('description');
			$table->string('country');
			$table->string('brand');
			$table->bigInteger('category_id')->unsigned();
			$table->bigInteger('sub_category_id')->unsigned();
			$table->bigInteger('unit_id')->unsigned();
			$table->bigInteger('currency_id')->unsigned()->default(1);

			$table->decimal('last_purchase', 15, 2);
			$table->decimal('profit_margin', 10, 2);
			$table->decimal('admin_expense', 10, 2);
			$table->decimal('value_cost', 15, 2);
			$table->decimal('price_cost', 15, 2);
			$table->decimal('value', 15, 2);
			$table->decimal('price', 15, 2);
			$table->boolean('use_set_value');
			$table->boolean('is_downloadable');
			$table->boolean('is_variable');
			$table->boolean('is_visible');
            $table->bigInteger('my_company')->unsigned();

            $table->foreign('my_company')->references('id')->on('companies');
			$table->foreign('unit_id')->references('id')->on('tables');
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
		Schema::dropIfExists('products');
	}

}
