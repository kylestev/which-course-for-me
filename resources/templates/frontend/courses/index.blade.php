@extends('layouts.frontend')

@section('content')
   
	<div class="container-fluid">

	@foreach($courses as $course)

	@include('layouts.courses.course', [
		'course' => $course,
		'single_page' => false,
	])

	@endforeach

	</div>

@stop
