<?php

use Illuminate\Database\Migrations\Migration;

class CreateEmbarcacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('embarcaciones', function ($table) {
				$table->increments('id');
				$table->string('embarcacion');
				$table->string('orden');
				$table->integer('abordajeMaximo');
				$table->integer('abordajeNormal');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('embarcaciones');
	}

}
