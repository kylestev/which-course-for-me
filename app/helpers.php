<?php

/**
 * Determines if an array is associative
 *
 * @author http://stackoverflow.com/a/4254008/758310
 */
function is_assoc($array)
{
	return (bool) count(array_filter(array_keys($array), 'is_string'));
}

function choose_case($idx, $word)
{
	$no_caps = array('in', 'of', 'to', 'and', 'be', 'for', 'the');
	$always_caps = array('ii', 'iii', 'iv', 'v', 'vi', 'osu', 'usa', 'u.s.', 'esl');

	if (in_array($word, $always_caps))
	{
		return strtoupper($word);
	}
	elseif (! in_array($word, $no_caps) || $idx === 0)
	{
		return ucfirst($word);
	}

	return $word;
}

function title_case($s)
{
	$words = explode(' ', strtolower($s));
	foreach ($words as $key => $word)
	{
		$words[$key] = choose_case($key, $word);
	}

    return implode(' ', $words);
}

function osu_catalog($subj_id, $course_id)
{
	return sprintf('http://catalog.oregonstate.edu/CourseDetail.aspx?subjectcode=%s&coursenumber=%s', $subj_id, $course_id);
}

function term_name($term)
{
	$mapping = ['F' => 'Fall', 'W' => 'Winter', 'Sp' => 'Spring', 'Su' => 'Summer'];

	$year = substr($term, -2);
	$quarter = substr($term, 0, strlen($term) - 2);

	return sprintf('%s 20%s', $mapping[$quarter], $year);
}