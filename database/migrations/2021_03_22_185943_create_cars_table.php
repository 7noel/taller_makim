<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('my_company')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->string('placa', 10);
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('modelo_id')->unsigned();
            $table->decimal('year', 4, 0);
            $table->string('version', 50);
            $table->string('body', 50);
            $table->string('color', 50);
            $table->string('vin', 50);
            $table->string('motor', 50);
            $table->string('codigo', 10);
            $table->date('f_revision');
            $table->date('f_llamada');
            $table->date('f_recordatorio');
            $table->date('f_next_pr');
            $table->boolean('add_contact');
            $table->string('contact_name', 50);
            $table->string('contact_email', 50);
            $table->string('contact_phone', 50);
            $table->string('contact_mobile', 50);

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
        Schema::dropIfExists('cars');
    }
}
