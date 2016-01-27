<div class="content">

	<div class="ajax_pagination" scrollup="false">
		{!! $escalation_profiles->render() !!}
	</div>

	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr class="orderable">
				<th column="name">Name</th>
				<th column="name">Description</th>
				<th column="name">Created</th>
				<th column="name">Updated</th>
			</tr>
		</thead>
		<tbody>

			@if ($escalation_profiles->count())
				@foreach ($escalation_profiles as $escalation_profile) 	

				<tr>
					<td> <a href="{{ route('escalation_profiles.show', $escalation_profile->id) }}"> {{ $escalation_profile->name }} </a> </td>
					<td> <a href="{{ route('escalation_profiles.show', $escalation_profile->id) }}"> {{ $escalation_profile->description }} </a> </td>
					<td> {{ $escalation_profile->date("created_at") }} </td>
					<td> {{ $escalation_profile->date("updated_at") }} </td>
				</tr>
				@endforeach
			@else 
				<tr><td colspan="4">@include('includes.no-contents')</td></tr>
			@endif 

		</tbody>
	</table>

	<div class="ajax_pagination" scrollup="true">
		{!! $escalation_profiles->render() !!}
	</div>
</div>