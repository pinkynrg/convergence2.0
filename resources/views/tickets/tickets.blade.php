<div class="content">

	@if (Route::currentRouteName() == "tickets.index")
		<div class="ajax_pagination" scrollup="false">
			{!! $tickets->appends(Input::except('page'))->render() !!}
		</div>
	@endif

	<table id="tickets_table" class="table table-striped table-condensed table-hover">
		<thead>
			<tr class="orderable">
				<th column="statuses.name">Status</th>
				<th column="tickets.id" weight="0" type="desc">Ticket</th>
				<th column="tickets.title">Title</th>
				<th column="priorities.id" class="hidden-xs">Priority</th>
				<th column="assignees.last_name" class="hidden-xs hidden-ms">Assignee</th>
				
				@if (Route::currentRouteName() == "tickets.index")
					<th column="companies.name" class="hidden-xs hidden-ms">Company</th>
				@endif

				<th column="divisions.name" class="hidden-xs hidden-ms">Division</th>
				<th column="last_operation_date" class="hidden-xs">Updated</th>
				<th column="levels.name" class="hidden-xs hidden-ms">Level</th>
				
				@if (Auth::user()->active_contact->isE80())
					<th column="deadline" class="hidden-xs hidden-ms hidden-sm">Deadline</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@if ($tickets->count())
				@foreach ($tickets as $ticket) 	

				<tr>
					<td class="ticket_status {{ $ticket->status->color_class() }}">
						<div data-toggle="tooltip" data-placement="right" title="{{ $ticket->status->name }}"><i class="{{ $ticket->status->icon() }}"></i></div>
					</td>
					<td> <a href="{{ route('tickets.show', $ticket->id) }}"> {{ "#".$ticket->id }} </a> </td>
					<td> 
						<div class="visible-xs visible-ms ticket_head_details">
							<a href="{{ route('companies.show', $ticket->company->id) }}"> {{ $ticket->company->name }} </a>
						</div>
						<div>
							<b><a href="{{ route('tickets.show', $ticket->id) }}"> {{ $ticket->title }} </a></b>
						</div>
						<div class="ticket_foot_details"> 
							Reported by <a href="{{ route('people.show', $ticket->creator->person->id) }}"> {{ $ticket->creator->person->name() }} </a> on {{ date("m/d/Y",strtotime($ticket->created_at)) }} 
						</div>
					</td>
					<td class="hidden-xs nowrap"> 
						@if (count($ticket->priority)) 
							{{ $ticket->priority->label }} ({{ $ticket->priority->weight }}) 
						@else
							TBA
						@endif
					</td>
					<td class="hidden-xs hidden-ms"> 
						@if (count($ticket->assignee)) 
							<a href="{{ route('people.show', $ticket->assignee->person->id) }}"> {{ $ticket->assignee->person->name() }} </a> 
						@else
							TBA
						@endif
					</td>
					
					@if (Route::currentRouteName() == "tickets.index")
						<td class="hidden-xs hidden-ms"> <a href="{{ route('companies.show', $ticket->company->id) }}"> {{ $ticket->company->name }} </a> </td>
					@endif

					<td class="hidden-xs hidden-ms"> 
						@if (count($ticket->division)) {{ $ticket->division->label }} @else TBA @endif
					</td>

					<td class="hidden-xs"> 
						{{ date("m/d/Y",strtotime($ticket->last_operation_date )) }}
						<div class="ticket_foot_details nowrap"> by 
							<a href="{{ route('people.show', $ticket->last_operation_company_person->person_id) }}"> 
								{{ $ticket->last_operation_company_person->person->name() }} 
							</a> 
						</div>
					</td>
					<td class="hidden-xs hidden-ms nowrap">
						@if (count($ticket->level)) {{ $ticket->level->name }} @else TBA @endif
					</td>
						@if (Auth::user()->active_contact->isE80())
							<td class="hidden-xs hidden-ms hidden-sm nowrap">
								@if ($ticket->deadline)
									@if ($ticket->E80_working())
										@if ($ticket->deadline < 0)
											<div class="escalation_time escalation_expired">
												{{ $ticket->deadline() }}
												<div class="escalation_foot_details"> 
													<b>Escalate</b>
												</div>
											</div>
										@else
											<div class="escalation_time">
												{{ $ticket->deadline() }}
												<div class="escalation_foot_details"> 
													<b>Time Left</b>
												</div>
											</div>
										@endif
									@else
										<div class="escalation_time escalation_paused">
											{{ $ticket->deadline() }}
											<div class="escalation_foot_details"> 
												<b>Paused</b>
											</div>
										</div>
									@endif
								@else
									<div class="escalation_time escalation_off"><b>OFF</b></div>
								@endif
							</td>
						@endif
				</tr>

				@endforeach
			@else 
				<tr><td colspan="100%">@include('includes.no-contents')</td></tr>
			@endif

		</tbody>
	</table>

	@if (Route::currentRouteName() == "tickets.index")
		<div class="ajax_pagination" scrollup="true">
			{!! $tickets->render() !!}
		</div>
	@else
		<div class="ajax_pagination" scrollup="false">
			{!! $tickets->render() !!}
		</div>
	@endif

</div>