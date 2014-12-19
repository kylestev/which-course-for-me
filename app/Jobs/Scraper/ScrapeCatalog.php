<?php namespace Courses\Jobs\Scraper;

use Courses\Course;
use Courses\Instructor;
use Courses\Section;
use Courses\SectionEnrollment;
use Courses\SectionType;
use Courses\Subject;

use Illuminate\Database\Eloquent\Model;

class ScrapeCatalog {

	const CATALOG_URL = 'http://catalog.oregonstate.edu/CourseDetail.aspx?Columns=afghjklmopqrstuvz&SubjectCode=%s&CourseNumber=%s';

	// http://stackoverflow.com/a/2087136/758310
	private function DOMinnerHTML(\DOMElement $element)
	{
		$innerHTML = "";
		$children  = $element->childNodes;

		foreach ($children as $child)
		{
			$innerHTML .= $element->ownerDocument->saveHTML($child);
		}

		return trim($innerHTML);
	}

	public function fire($job, $data)
	{
		try
		{
			$this->work($data);
			$job->delete();
		}
		catch (\ErrorException $e)
		{
			$job->release();
			throw $e;
		}
	}

	public function work($data)
	{
		Model::unguard();

		print_r($data);

		$url = sprintf(self::CATALOG_URL, $data['subject'], $data['level']);
		$contents = file_get_contents($url);

		libxml_use_internal_errors(true);

		$dom = new \DOMDocument;
		$dom->loadHTML($contents);

		$course_info = [];

		foreach ($dom->getElementsByTagName('h3') as $key)
		{
			$asdf = preg_match('~\s+([A-Z]+\s+\d+[A-Z]*)\.\s+([^\n]+)\s+\((\d+).*\)\.\s+~', $key->textContent, $matches);
			$course_id = $data['subject'] . $data['level'];
			$course_info['id'] = $course_id;

			$course = Course::firstOrNew($course_info);

			$course_info['level'] = $data['level'];
			$course_info['title'] = trim($matches[2]);
			$course_info['description'] = trim($key->nextSibling->wholeText);
			$course_info['subject_id'] = Subject::find($data['subject'])->id;

			if (!is_null($dom->getElementById('ctl00_ContentPlaceHolder1_lblCoursePrereqs')))
			{
				$course_info['prereqs'] = trim($dom->getElementById('ctl00_ContentPlaceHolder1_lblCoursePrereqs')->nextSibling->wholeText);
			}

			foreach ($course_info as $key => $value)
			{
				$course->$key = $value;
			}

			$course->save();

			break;
		}

		$table = $dom->getElementById("ctl00_ContentPlaceHolder1_SOCListUC1_gvOfferings");

		if (is_null($table))
		{
			return;
		}

		$i = 0;
		$rows = $table->getElementsByTagName('tr');

		foreach ($rows as $row)
		{
			if ($i++ == 0) continue;

			$section_info = [
				'id' => intval($row->childNodes->item(1)->textContent),
				// 'campus_id' => find_or_insert_campus($row->childNodes->item(7)->textContent),
				'course_id' => $course_id,
			];

			$sec = Section::firstOrNew($section_info);

			$values = [
				'term' => trim($row->childNodes->item(0)->textContent),
				'section_number' => intval($row->childNodes->item(2)->textContent),
				'credits' => intval($row->childNodes->item(3)->textContent),
				'raw_times' => $this->DOMinnerHTML($row->childNodes->item(5)->childNodes->item(0)),
				'raw_locations' => $this->DOMinnerHTML($row->childNodes->item(6)->childNodes->item(0)),
				'instructor_id' => Instructor::firstOrCreate(['name' => $row->childNodes->item(4)->textContent])->id,
				'section_type_id' => SectionType::firstOrCreate(['name' => $row->childNodes->item(8)->textContent])->id,
			];

			foreach ($values as $key => $value)
			{
				$sec->$key = $value;
			}

			$current_enrollment = [
				'cap' => intval($row->childNodes->item(10)->textContent),
				'current' => intval($row->childNodes->item(11)->textContent),
				'available' => intval($row->childNodes->item(12)->textContent),
			];

			$waitlist_enrollment = [
				'cap' => intval($row->childNodes->item(13)->textContent),
				'current' => intval($row->childNodes->item(14)->textContent),
				'available' => intval($row->childNodes->item(15)->textContent),
			];

			if (is_null($sec->waitlist_enrollment_id))
			{
				$sec->waitlist_enrollment_id = SectionEnrollment::create($waitlist_enrollment)->id;
			}

			$waitlist = SectionEnrollment::find($sec->waitlist_enrollment_id);
			foreach ($waitlist_enrollment as $key => $value) {
				$waitlist->$key = $value;
			}
			$waitlist->save();

			if (is_null($sec->current_enrollment_id))
			{
				$sec->current_enrollment_id = SectionEnrollment::create($current_enrollment)->id;
			}

			$current = SectionEnrollment::find($sec->current_enrollment_id);
			foreach ($current_enrollment as $key => $value) {
				$current->$key = $value;
			}
			$current->save();

			$sec->save();
		}
	}
}
