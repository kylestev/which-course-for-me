<?php

use Courses\Course;
use Courses\Instructor;
use Courses\Section;
use Courses\SectionType;
use Courses\SectionEnrollment;
use Courses\Subject;

use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	const FAKER_SEED = 1337;

	protected $faker;

	public function __construct()
	{
		$this->faker = Faker::create();
		$this->faker->seed(self::FAKER_SEED);
		$this->faker->addProvider(new \Faker\Provider\en_US\Person($this->faker));
		$this->faker->addProvider(new \Faker\Provider\Internet($this->faker));
		$this->faker->addProvider(new \Faker\Provider\Lorem($this->faker));
	}

	protected function truncateTables()
	{		
		DB::table('sections')->truncate();
		DB::table('section_types')->truncate();
		DB::table('section_enrollments')->truncate();
		DB::table('instructors')->truncate();
		DB::table('courses')->truncate();
		DB::table('subjects')->truncate();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$s = time();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->truncateTables();

		$this->call('SubjectSeeder');
		$this->call('SectionTypeSeeder');
		$this->call('InstructorSeeder');
		$this->call('CourseSeeder');
		$this->call('SectionSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$e = time();

		$this->command->info(sprintf('Seeded tables in %ds', $e - $s));
	}

}

class SubjectSeeder extends DatabaseSeeder {

	public function run()
	{
		foreach (range(1, 5) as $idx)
		{
			$name = ucwords($this->faker->sentence(2));

			$id = '';
			foreach (explode(' ', $name) as $word) {
				$id .= $word[0];
			}

			$data = [
				'id' => $id,
				'name' => $name,
			];

			Subject::create($data);
		}
	}

}

class SectionTypeSeeder extends DatabaseSeeder {

	public function run()
	{
		$types = ['Lecture', 'Streaming Media', 'Thesis', 'Project',
				  'Laboratory', 'Recitation', 'WWW', 'Research'];

		foreach ($types as $type)
		{
			SectionType::create(['name' => $type]);
		}
	}

}

class InstructorSeeder extends DatabaseSeeder {

	public function run()
	{
		foreach (range(1, 30) as $idx)
		{
			$name = $this->faker->name;
			$email = $this->faker->email;
			$email = explode('@', $email)[0] . '@oregonstate.edu';

			$data = [
				'name' => $name,
				'email' => $email,
			];

			Instructor::create($data);
		}
	}

}

class CourseSeeder extends DatabaseSeeder {

	private function createCourse(Subject $subj)
	{
		$title = title_case($this->faker->sentence(5));
		$level = $this->faker->numberBetween(100, 800);
		$description = $this->faker->text(200);

		$data = [
			'id' => sprintf('%s%d', $subj->id, $level),
			'subject_id' => $subj->id,
			'level' => $level,
			'title' => $title,
			'description' => $description,
		];

		try
		{
			Course::create($data);
		}
		catch (QueryException $e) { }
	}

	private function createCourses($subj)
	{
		foreach (range(0, $this->faker->numberBetween(2, 5)) as $idx)
		{
			$this->createCourse($subj);
		}
	}

	public function run()
	{
		foreach (Subject::all() as $subj)
		{
			$this->createCourses($subj);
		}
	}

}

class SectionSeeder extends DatabaseSeeder {

	protected $instructors;

	protected $section_types;

	protected $terms;

	public function __construct()
	{
		parent::__construct();

		$this->instructors = Instructor::all();
		$this->section_types = SectionType::all();
		$this->terms = ['W15', 'Sp15', 'Su15'];
	}

	private function getRandomInstructor()
	{
		$idx = $this->faker->numberBetween(0, sizeof($this->instructors) - 1);

		return $this->instructors[$idx];
	}

	private function getRandomSectionType()
	{
		$idx = $this->faker->numberBetween(0, sizeof($this->section_types) - 1);

		return $this->section_types[$idx];
	}

	private function getRandomTerm()
	{
		$idx = $this->faker->numberBetween(0, sizeof($this->terms) - 1);

		return $this->terms[$idx];
	}

	private function createCurrentEnrollment()
	{
		$cap = $this->faker->numberBetween(3, 25) * 10;

		if ($this->faker->numberBetween(1, 3) === 3)
		{
			$current = $cap;
		}
		else
		{
			$current = $this->faker->numberBetween(0, $cap);
		}

		$available = $cap - $current;

		return SectionEnrollment::create([
			'cap' => $cap,
			'current' => $current,
			'available' => $available,
		]);
	}

	private function createWaitlistEnrollment(SectionEnrollment $current_enrollment)
	{
		// TODO: use real logic (only set current if the class is full)
		$cap = $this->faker->numberBetween(1, 2) * 10;

		if ($current_enrollment->available === 0)
		{
			$current = $this->faker->numberBetween(0, $cap);
		}
		else
		{
			$current = 0;
		}

		$available = $cap - $current;

		return SectionEnrollment::create([
			'cap' => $cap,
			'current' => $current,
			'available' => $available,
		]);
	}

	private function createSection(Course $course)
	{
		$section_type = $this->getRandomSectionType();
		$instructor = $this->getRandomInstructor();

		$current = $this->createCurrentEnrollment();
		$current_id = $current->id;
		$waitlist_id = $this->createWaitlistEnrollment($current)->id;

		$term = $this->getRandomTerm();
		$section = $this->faker->numberBetween(100, 499);
		$notes = $this->faker->text(200);

		$data = [
			'course_id' => $course->id,
			'section_type_id' => $section_type->id,
			'instructor_id' => $instructor->id,
			'current_enrollment_id' => $current_id,
			'waitlist_enrollment_id' => $waitlist_id,
			'term' => $term,
			'section_number' => $section,
			'fees' => null,
			'notes' => $notes
		];

		return new Section($data);
	}

	private function createSections($course)
	{
		$sections = [];

		$num_sections = $this->faker->numberBetween(0, 30);

		if ($this->faker->numberBetween(0, 7) == 5)
		{
			$num_sections = 0;
		}

		foreach (range(0, $num_sections) as $idx)
		{
			$sections []= $this->createSection($course);
		}
		return $sections;
	}

	public function run()
	{
		foreach (Course::all() as $course)
		{
			$sections = $this->createSections($course);
			$course->sections()->saveMany($sections);
		}
	}

}
