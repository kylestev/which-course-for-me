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

			@include('layouts.courses.course', [
				'course' => $course,
				'single_page' => false,
			])

	@endforeach

	<center>
		{!! $courses->render() !!}
	</center>

@stop

