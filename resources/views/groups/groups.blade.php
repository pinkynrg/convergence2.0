<div class="content">

	<div class="ajax_pagination" scrollup="false">
		{!! $groups->render() !!}
	</div>

	<table class="table table-striped table-hover">
		<thead>
			<tr class="orderable">
				<th column="groups.display_name" weight="0" type="asc">Display Name</th>
				<th column="groups.name" class="hidden-xs hidden-ms">Name</th>
				<th column="group_types.display_name">Group Type</th>
				<th column="groups.description" class="hidden-xs hidden-ms">Description</th>
				<th column="name" class="hidden-xs hidden-ms">Created</th>
				<th column="name" class="hidden-xs hidden-ms">Updated</th>
			</tr>
		</thead>
		<tbody>
			
			@if ($groups->count())
				@foreach ($groups as $group) 	
				<tr>
					<td> <a href="{{route('groups.show', $group->id) }}"> {{  $group->display_name }} </a> </td>
					<td class="hidden-xs hidden-ms"> <a href="{{route('groups.show', $group->id) }}"> {{  $group->name }} </a> </td>
					<td> <a href="{{route('groups.show', $group->id) }}"> {{  $group->group_type->display_name }} </a> </td>
					<td class="hidden-xs hidden-ms"> <a href="{{route('groups.show', $group->id) }}"> {{  $group->description }} </a> </td>
					<td class="hidden-xs hidden-ms"> {{ $group->date("created_at") }} </td>
					<td class="hidden-xs hidden-ms"> {{ $group->date("updated_at") }} </td>
				</tr>

				@endforeach
			@else 
				<tr><td colspan="100%">@include('includes.no-contents')</td></tr>
			@endif 

		</tbody>
	</table>

	<div class="ajax_pagination" scrollup="true">
		{!! $groups->render() !!}
	</div>

</div>