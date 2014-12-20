@extends('layouts.frontend')

@section('content')

	<h1>Which Course For Me Backend Architecture</h1>

	<h2>The Stack</h2>

	<h3>Backend</h3>

	<p>
		On the backend, WCFM utilizes the Laravel 5 framework in order to ease development pains and keep all code neatly organized.

		Below you'll find a table of technologies used, and what their role is on the backend.
	</p>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Software</th>
				<th>Use</th>
				<th>Link</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>
					Laravel 5
				</td>
				<td>
					Laravel is the PHP web framework that powers both the API and the content you see on the fronend website.
				</td>
				<td>
					<a href="http://laravel.com/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					Ubuntu 14.04
				</td>
				<td>
					Ubuntu is the operating system used on all nodes in the WCFM architecture.
				</td>
				<td>
					<a href="http://www.ubuntu.com/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					nginx
				</td>
				<td>
					Nginx serves up content rendered by Laravel. Content from the API and the frontend utilize
					<a href="https://en.wikipedia.org/wiki/Forward_secrecy">Forward Secrecy</a> to protect content
					in transit between the clients and our servers.
				</td>
				<td>
					<a href="http://nginx.org/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					Redis
				</td>
				<td>
					Redis all in memory caching and message queueing needs for the WCFM applications.
				</td>
				<td>
					<a href="http://redis.io/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					HHVM
				</td>
				<td>
					The HipHop Virtual Machine is an Open Source project started at Facebook that is used to serve dynamic content rendered by PHP at blazing fast speeds.
				</td>
				<td>
					<a href="http://hhvm.com/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					InfluxDB
				</td>
				<td>
					InfluxDB is a relatively new time-series database that WCFM uses to collect metrics from all parts of the application.
				</td>
				<td>
					<a href="http://influxdb.com/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					Grafana
				</td>
				<td>
					Grafana is used for making graphs from collected metrics. This allows for operators to have an instant high level view of what's going on inside the system.
				</td>
				<td>
					<a href="http://grafana.org/">Link</a>
				</td>
			</tr>
			<tr>
				<td>
					Papertrail
				</td>
				<td>
					Papertrail allows for searching through log files without needing to ssh into all the servers used in our system.
				</td>
				<td>
					<a href="https://papertrailapp.com/">Link</a>
				</td>
			</tr>
		</tbody>
	</table>

	<!-- <img src="https://i.imgur.com/4UIahNp.png" /> -->

@stop
