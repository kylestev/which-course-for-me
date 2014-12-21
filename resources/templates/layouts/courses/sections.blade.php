
		<br />
		<br />

		<h2>Sections</h2>

		@if (sizeof($terms) == 0)
		
		  <p>
			There are no upcoming sections of this course planned.
		  </p>
		@else


		<ul class="nav nav-tabs nav-justified">
		<?php $first = false; ?>
		@foreach($terms as $term)
		  <li <?php if (! $first) { $first = $term['id']; echo 'class="active"'; } ?>><a href="#{{ $term['id'] }}" data-toggle="tab">{{ $term['name'] }}</a></li>
		@endforeach
		</ul>

		<div id="sectionsByTerm" class="tab-content">
		  @foreach($terms as $term)

			<div class="tab-pane table-responsive fade {{ ($first == $term['id']) ? 'active' : '' }} in" id="{{ $term['id'] }}">
			  <table class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>CRN</th>
					<th>Section</th>
					<th>Credits</th>
					<th>Meeting Times</th>
					<th>Location</th>
					<th>Type</th>
					<th>Instructor</th>
					<th>Seats Filled</th>
					<th>Waitlist</th>
				  </tr>
				</thead>
				<tbody>
				  @foreach (array_get($term, 'sections') as $section)

					<tr>
					  <td>{{ array_get($section, 'id') }}</td>
					  <td>{{ str_pad(array_get($section, 'section_number'), 3, '0', STR_PAD_LEFT) }}</td>
					  <td>{{ array_get($section, 'credits') }}</td>
					  <td>{!! extract_times($section) !!}</td>
					  <td>{!! array_get($section, 'raw_locations') !!}</td>
					  <td>{{ array_get($section, 'section_type.name') }}</td>
					  <td>{{ array_get($section, 'instructor.name') }}</td>
					  <td>
						<em>
							{{ array_get($section, 'enrollment_current.current') }}
							/ {{ array_get($section, 'enrollment_current.cap') }}
						</em>
					  </td>
					  <td>
						@if (array_get($section, 'enrollment_waitlist.cap') == 0)
						  Unavailable.
						@else
						<em>
							{{ array_get($section, 'enrollment_waitlist.current') }}
							/ {{ array_get($section, 'enrollment_waitlist.cap') }}
						</em>
						@endif
					  </td>
					</tr>
				  @endforeach
				</tbody>
			  </table>
			</div>

		  @endforeach

		</div>
		@endif
