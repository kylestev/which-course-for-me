@extends('layouts.frontend')

@section('content')

	<h1>Uh-oh...</h1>

	<p>
		{{ isset($error) ? $error->getMessage() : 'Request resource was not found' }}!
	</p>

@stop
