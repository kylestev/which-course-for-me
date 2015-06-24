@extends('layouts.frontend')

@section('content')

	<div class="container-fluid">

	@foreach ($subjects as $subject)

			<div class="row">
				<h2>
					{{ array_get($subject, 'id') }} -
					{{ array_get($subject, 'name') }}
				</h2>

				<a href="{{ route('frontend.subjects.show', array_get($subject, 'id')) }}">
					View {{ array_get($subject, 'name') }} courses
				</a>
			</div>

	@endforeach

	<center>
		{!! $subjects->render() !!}
	</center>

	</div>

@stop
