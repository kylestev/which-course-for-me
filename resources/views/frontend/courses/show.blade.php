@extends('layouts.frontend')

@section('content')

	  <div class="row container-fluid">
		<ol class="breadcrumb">
		  <li>
			<a href="{{ route('frontend.subjects.index') }}">Subjects</a>
		  </li>
		  <li>
			<a href="{{ route('frontend.subjects.show', array_get($course, 'subject.id')) }}">
			  {{ array_get($course, 'subject.id') }} Courses
			</a>
		  </li>
		  <li class="active">
			{{ array_get($course, 'subject.id') }}
			{{ array_get($course, 'level') }}
		  </li>
		</ol>
	  </div>

	  @include('layouts.courses.course')

@stop

