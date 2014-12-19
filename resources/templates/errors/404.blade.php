@extends('layouts.frontend')

@section('content')

	<h1>Uh-oh...</h1>

	<p>
		{{ $error->getMessage() }}!
	</p>

@stop
