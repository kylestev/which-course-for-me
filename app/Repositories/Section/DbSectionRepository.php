<?php

namespace Courses\Repositories\Section;

use Courses\Exceptions\NotFoundException;
use Courses\Section;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbSectionRepository implements SectionRepositoryInterface
{

    private function sortSections($sections)
    {
        $sorts = ['F' => 1, 'W' => 2, 'Sp' => 3, 'Su' => 4];

        return array_sort($sections, function ($section) use ($sorts) {
            $term = array_get($section, 'term');
            $year = substr($term, -2);
            $quarter = substr($term, 0, strlen($term) - 2);

            return [$year, array_get($sorts, $quarter), array_get($section, 'section_number')];
        });
    }

    private function getAllByCourseId($courseId)
    {
        return Section::with('section_type', 'course.subject', 'enrollment_current', 'enrollment_waitlist', 'instructor')
            ->whereCourseId($courseId);
    }

    public function all($courseId)
    {
        return $this->getAllByCourseId($courseId)->get();
    }

    public function find($courseId, $crn)
    {
        try {
            return $this->getAllByCourseId($courseId)
                        ->findOrFail($crn);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException(sprintf('Section (%s) not found under Course (%s)', $crn, $courseId));
        }
    }

    public function paginateResults($courseId)
    {
        return $this->getAllByCourseId($courseId)
                    ->skip(\Request::input('page', 1))
                    ->limit(pagination_pages())
                    ->get();
    }

}
