<?php namespace Courses\Jobs\Scraper;

use Courses\Course;

class ScrapeSubject {

	const CATALOG_URL = 'http://catalog.oregonstate.edu/CourseList.aspx?campus=corvallis&subjectcode=%s';

	public function fire($job, $data)
	{
		$url = sprintf(self::CATALOG_URL, $data['subject']);
		$contents = file_get_contents($url);

		libxml_use_internal_errors(true);

		$dom = new \DOMDocument;
		$dom->loadHTML($contents);

		$table = $dom->getElementById("ctl00_ContentPlaceHolder1_dlCourses");

		if (is_null($table))
		{
			$job->delete();
			return;
		}

		$rows = $table->getElementsByTagName('tr');
		foreach ($rows as $row)
		{
			$td = $row->childNodes->item(0);
			$info = $td->childNodes->item(2)->childNodes->item(0)->attributes->getNamedItem('name')->textContent;
			$split = explode(' ', $info);
			if (Course::find(implode('', explode(' ', $info))) == null)
			{
				if (in_array($info[strlen($info) - 1], ['H', 'X'])) continue;
			}

			\Queue::push('Courses\Jobs\Scraper\ScrapeCatalog', [
				'subject' => $data['subject'],
				'level' => $split[1]
			]);
		}

		$job->delete();
	}
}
