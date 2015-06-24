
			<div>
				<div class="page-header">
					<h2> {{ array_get($course, 'subject.id') }} {{ array_get($course, 'level') }} &nbsp;
						<small>{{ array_get($course, 'title') }}</small>
					</h2>
				</div>
				<blockquote>
					{{ array_get($course, 'description') }}
				</blockquote>
				@if (array_get($course, 'prereqs'))
					<h4>Prerequisites</h4>
					<blockquote>{{ array_get($course, 'prereqs') }}</blockquote>
				@endif

				<a href="{{ osu_catalog(array_get($course, 'subject_id'), array_get($course, 'level')) }}">
					View on the official OSU Catalog
				</a>

				@include('layouts.courses.sections')
			</div>
