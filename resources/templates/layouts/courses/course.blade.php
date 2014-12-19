
			<div>
				<div class="page-header">
					<h2> {{ array_get($course, 'subject.id') }} {{ array_get($course, 'level') }} &nbsp;
						<small>{{ array_get($course, 'title') }}</small>
					</h2>
				</div>
				<blockquote>
					@if (! $single_page)
						{{ str_limit(array_get($course, 'description'), 100) }}
					@else
						{{ array_get($course, 'description') }}
					@endif
				</blockquote>
				@if ($single_page and $course['prereqs'])
					<h4>Prerequisites</h4>
					<blockquote>{{ $course['prereqs'] }}</blockquote>
				@endif
				@if ( ! $single_page)
					<span>
						<a href="{{ route('frontend.courses.show', [array_get($course, 'subject_id'), array_get($course, 'id')]) }}">More details</a>
					</span>
					&nbsp;&ndash;&nbsp;
					<span>
						{{ $course->current_sections() }}
						{{ $course->current_sections() == 1 ? 'section' : 'sections' }}
						available during {{ term_name(env('CURRENT_TERM')) }}
					</span>
				@else
					<a href="{{ osu_catalog(array_get($course, 'subject_id'), array_get($course, 'level')) }}">
						View on the official OSU Catalog
					</a>
				@endif

				@if ($single_page)
					@include('layouts.courses.sections')
				@endif
			</div>
