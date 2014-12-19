@extends('layouts.frontend')

@section('header')

	<div class="row course-row">
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('frontend.subjects.index') }}">Subjects</a>
			</li>
			<li>
				{{ $subject_id }} Courses
			</li>
		</ol>
	</div>

	<h1>{{ $subject_id }} Courses</h1>

	<hr />

@stop

@section('content')

	@foreach($courses as $course)

			@include('layouts.courses.course', [
				'course' => $course,
				'single_page' => false,
			])

	@endforeach

	<center>
		{!! $courses->render() !!}
	</center>

@stop
