<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('course_id', 10);
			$table->foreign('course_id')
					->references('id')
					->on('courses')
					->onDelete('cascade');

			$table->integer('section_type_id')->unsigned();
			$table->foreign('section_type_id')
					->references('id')
					->on('section_types')
					->onDelete('cascade');

			$table->integer('instructor_id')->unsigned();
			$table->foreign('instructor_id')
					->references('id')
					->on('instructors')
					->onDelete('cascade');

			$table->integer('current_enrollment_id')->unsigned()->nullable();
			$table->foreign('current_enrollment_id')
					->references('id')
					->on('section_enrollments')
					->onDelete('cascade');

			$table->integer('waitlist_enrollment_id')->unsigned()->nullable();
			$table->foreign('waitlist_enrollment_id')
					->references('id')
					->on('section_enrollments')
					->onDelete('cascade');

			$table->string('term', 4);
			$table->integer('section_number')->unsigned();
			$table->text('fees')->nullable();
			$table->text('notes')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sections');
	}

}
