@extends('layouts.frontend')

@section('header')

	<div class="row container-fluid">
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('frontend.subjects.index') }}">Subjects</a>
			</li>
			<li>
				{{ array_get($subj, 'id') }} Courses
			</li>
		</ol>
	</div>

	<h1>{{ array_get($subj, 'name') }} Courses</h1>

	<hr />

@stop

@section('content')

	@foreach($courses as $course)

		<div>
			<div class="page-header">
				<h2> {{ array_get($course, 'subject.id') }} {{ array_get($course, 'level') }} &nbsp;
					<small>{{ array_get($course, 'title') }}</small>
				</h2>
			</div>
			<blockquote>
					{{ array_get($course, 'description') }}
			</blockquote>
			<span>
				{{ $course->current_sections() }}
				{{ $course->current_sections() == 1 ? 'section' : 'sections' }}
				available during {{ term_name(env('CURRENT_TERM')) }}
			</span>
			&nbsp;&ndash;&nbsp;
			<span>
				<a href="{{ route('frontend.courses.show', [array_get($course, 'subject_id'), array_get($course, 'id')]) }}">More details</a>
			</span>
		</div>


	@endforeach

	<center>
		{!! $courses->render() !!}
	</center>

@stop
