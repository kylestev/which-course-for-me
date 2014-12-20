<html>
<head>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"> -->
	<style type="text/css">
		* {
			-webkit-font-smoothing: antialiased;
		}

		a {
			-webkit-font-smoothing: !important antialiased;
		}

		.breadcrumb a {
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">Which Course For Me</a>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="{{ route('api.root') }}">API</a></li>
					</ul>
				</div>
			</div>
		</nav>

		@yield('header')

		@yield('content')

	</div>

	<footer>

		@section('footer')

		<!-- http://bootsnipp.com/snippets/featured/bootstrap-3-footer -->

		<div class="container text-center">
			<hr />

			<div class="row">
				<div class="col-lg-12">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{ route('frontend.about') }}">About</a></li>
							<li><a href="http://resume.kylestev.io/">Author</a></li>
						</ul>
					</div>
					<div class="col-md-5">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="http://docs.whichcourseforme.apiary.io/">API Documentation</a></li>
							<li><a href="{{ route('frontend.architecture') }}">Backend Architecture</a></li>
						</ul>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>

			<div style="margin-bottom: 60px"></div>
		</div>

		@show

	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.7/angular.min.js"></script>
	<script src="https://code.jquery.com/jquery-2.1.2.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

