<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->string('id', 10)->primary();

			$table->string('subject_id', 10)
					->foreign('subject_id')
					->references('id')
					->on('subjects')
					->onDelete('cascade');

			$table->integer('level')->unsigned();
			$table->string('title', 200);
			$table->text('description');
			$table->timestamps();

			$table->unique(['subject_id', 'level']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
