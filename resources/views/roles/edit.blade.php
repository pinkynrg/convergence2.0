@extends('layouts.default')
@section('content')
	
	{!! Form::model($role, array('method' => 'PATCH', 'route' => array('roles.update',$role->id), 'class' => "form-horizontal")) !!}

		@include('includes.errors')

		@include('group_types.form')

		{!! Form::BSSubmit("Submit",['bclass' => 'col-xs-offset-2']) !!}

	{!! Form::close() !!}

@endsection