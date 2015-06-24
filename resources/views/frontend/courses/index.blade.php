@extends('layouts.frontend')

@section('content')

	@foreach($courses as $course)

	@include('layouts.courses.course', [
		'course' => $course,
		'single_page' => false,
	])

	@endforeach

@stop
