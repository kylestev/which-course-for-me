@extends('layouts.frontend')

@section('header')

		<div class="jumbotron">
			<h1>Which Course For Me</h1>
			<p>
				The goal of this website is to provide an easier on the eyes alternative to the
				<a href="http://catalog.oregonstate.edu/SOC.aspx">
					Oregon State University Course Catalog
				</a>.
			</p>
			<p>
				All of the data used to make this site is updated daily by scraping the
				data from OSU's website. We make this information freely available via
				a JSON REST API which can be used without authentication and is
				not subject to rate limiting.
			<p>
				<a href="{{ route('frontend.about') }}" class="btn btn-primary btn-lg">Learn more</a>
				<a href="{{ route('api.root') }}" class="btn btn-primary btn-lg">Access the API</a>
			</p>
		</div>

@stop

@section('content')

	<p>
		To browse courses, head on over to <a href="{{ route('frontend.subjects.index') }}">the Subjects overview</a>.
	</p>

@stop
