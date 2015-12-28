@extends('layouts.default')

@section('content')

	@include('includes.errors')
	
	<div class="hidden-xs hidden-sm filters">
		
		<select column="company_id" class="selectpicker multifilter" multiple title="Companies" data-count-selected-text="Companies Active" data-selected-text-format="count>0">			
			@foreach ($companies as $company)
				<option value="{{ $company->id }}"> {{ $company->name }} </option>
			@endforeach
		</select>

		<select column="assignee_id" class="selectpicker multifilter"  multiple title="Assignees" data-count-selected-text="Assignees Active" data-selected-text-format="count>0">
			@foreach ($employees as $employee)
				<option value="{{ $employee->id }}"> {{ $employee->person->name() }} </option>
			@endforeach
		</select>

		<select column="creator_id" class="selectpicker multifilter"  multiple title="Creators" data-count-selected-text="Creators Active" data-selected-text-format="count>0">
			@foreach ($employees as $employee)
				<option value="{{ $employee->id }}"> {{ $employee->person->name() }} </option>
			@endforeach
		</select>

		<select column="division_id" class="selectpicker multifilter"  multiple title="Divisions" data-count-selected-text="Divisions Active" data-selected-text-format="count>0">
			@foreach ($divisions as $division)
				<option value="{{ $division->id }}"> {{ $division->name }} </option>
			@endforeach
		</select>

		<select column="status_id" class="selectpicker multifilter"  multiple title="Statuses" data-count-selected-text="Statuses Active" data-selected-text-format="count>0">
			@foreach ($statuses as $status)
				<option value="{{ $status->id }}"> {{ $status->name }} </option>
			@endforeach
		</select>

		<input type="button" class="btn btn-default" id="reset_filters" value="Reset">

	</div>

	@include('tickets/tickets', array('tickets' => $tickets))
	
@endsection
