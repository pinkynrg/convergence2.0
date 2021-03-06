<div class="content">

	@if (Route::currentRouteName() == "company_person.index")
		<div class="ajax_pagination" scrollup="false">
			{!! $contacts->render() !!}
		</div>
	@endif

	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr class="orderable">
				<th column="people.last_name" weight="0" type="asc">Name</th>
				
				@if (Route::currentRouteName() == "company_person.index")
					<th column="companies.name">Company</th>
				@endif 

				<th column="groups.name" class="hidden-xs hidden-ms">Permissions Group</th>

				@if (Route::currentRouteName() == "companies.contacts" || Route::currentRouteName() == "companies.show")
					<th column="is_main_contact">Main Contact</th>
				@endif

				<th column="company_person.email" class="hidden-xs hidden-ms">Email</th>
				<th column="company_person.cellphone" class="hidden-xs hidden-ms">Cellphone</th>
				<th column="company_person.phone" class="hidden-xs hidden-ms">Phone</th>
			</tr>
		</thead>
		<tbody>
		@if ($contacts->count())
			@foreach ($contacts as $contact) 	

			<tr>
				<td> <a href="{{ route('company_person.show', $contact->id) }}"> {{ $contact->person->name() }} </a> </td>
				
				@if (Route::currentRouteName() == "company_person.index")
					<td> <a href="{{ route('companies.show', $contact->company->id) }}"> {{ $contact->company->name }} </a> </td>
				@endif

				<td class="hidden-xs hidden-ms"> {{ $contact->group->display_name }} </td>			

				@if (Route::currentRouteName() == "companies.contacts" || Route::currentRouteName() == "companies.show")
					<td>
						@if ($contact->is_main_contact == 1) 
							<i class="fa fa-check-circle-o" style="color: #5EBA0A"></i> 
						@else
							<i class="fa fa-check-circle-o" style="color: #DDD"></i>
						@endif
					</td>
				@endif

				<td class="hidden-xs hidden-ms"> {{ $contact->email }} </td>			
				<td class="hidden-xs hidden-ms"> {!! $contact->cellphone() !!} </td>				
				<td class="hidden-xs hidden-ms"> {!! $contact->phone() !!} </td>
			</tr>

			@endforeach
		@else 
			<tr><td colspan="100%">@include('includes.no-contents')</td></tr>
		@endif 

		</tbody>
	</table>

	@if (Route::currentRouteName() == "company_person.index")
		<div class="ajax_pagination" scrollup="true">
			{!! $contacts->render() !!}
		</div>
	@endif 

	@if (Route::currentRouteName() == "companies.contacts" || Route::currentRouteName() == "companies.show" || Route::currentRouteName() == "companies.my_company")
		<div class="ajax_pagination" scrollup="false">
			{!! $contacts->render() !!}
		</div>
	@endif

</div>