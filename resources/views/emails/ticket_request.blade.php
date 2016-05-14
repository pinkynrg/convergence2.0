@extends('layouts.email')
@section('content')

	<h3><a href="{{SITE_URL."/tickets/".$ticket->id}}"> New Ticket Request: click here to visit the website </a></h3>

	<hr>

	<table class="table">
		<tr>
			<td class="bold" width="200">Ticket #</td><td>{{ $ticket->id }}</td>
		</tr>
		<tr>
			<td class="bold">Title</td><td>{{ $ticket->title }}</td>
		</tr>
		<tr>
			<td class="bold">Author</td><td>{{ $ticket->creator->person->name() }}</td>
		</tr>
		<tr>
			<td class="bold">Contact Name:</td><td>{{ isset($ticket->contact_id) ? $ticket->contact->person->name() : '-' }}</td>
		</tr>
		<tr>
			<td class="bold">Contact Phone:</td><td>{!! isset($ticket->contact_id) && isset($ticket->contact->phone) ? $ticket->contact->phone() : '-' !!}</td>
		</tr>
		<tr>
			<td class="bold">Contact Cellphone:</td><td>{!! isset($ticket->contact_id) && isset($ticket->contact->cellphone) ? $ticket->contact->cellphone() : '-' !!}</td>
		</tr>
		<tr>
			<td class="bold">Contact Email:</td><td>{!! isset($ticket->contact_id) && isset($ticket->contact->email) ? $ticket->contact->email() : '-' !!}</td>
		</tr>
	</table>

	<hr>

	<table class="table">
		<tr>
			<td width="50" class="thumbnail" rowspan="3"><img width="50" src="{{ SITE_URL.$ticket->creator->person->profile_picture()->path() }}"></td>
		</tr>
		
		<tr>
			<td> {{ $ticket->creator->person->name() }} </td>
		</tr>
		
		<tr>
			<td> {{ date("m/d/Y ~ h:i A",strtotime($ticket->created_at)) }} </td>
		</tr>
	</table>
		
	<div class="post">
		{!! $ticket->post('html') !!}
	</div>
	
@endsection
	