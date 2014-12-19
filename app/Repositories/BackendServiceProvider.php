<?php namespace Courses\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Courses\Repositories\Course\CourseRepositoryInterface',
			'Courses\Repositories\Course\DbCourseRepository'
		);

		$this->app->bind(
			'Courses\Repositories\Subject\SubjectRepositoryInterface',
			'Courses\Repositories\Subject\DbSubjectRepository'
		);

		$this->app->bind(
			'Courses\Repositories\Section\CourseSectionRepositoryInterface',
			'Courses\Repositories\Section\DbCourseSectionRepository'
		);

		$this->app->bind(
			'Courses\Repositories\Instructor\InstructorRepositoryInterface',
			'Courses\Repositories\Instructor\DbInstructorRepository'
		);

		$this->app->bind(
			'Courses\Repositories\Section\InstructorSectionRepositoryInterface',
			'Courses\Repositories\Section\DbInstructorSectionRepository'
		);

		$this->app->bind(
			'Courses\Repositories\SectionType\SectionTypeRepositoryInterface',
			'Courses\Repositories\SectionType\DbSectionTypeRepository'
		);
	}

}
