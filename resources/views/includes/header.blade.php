<?php use App\Http\Controllers\CompanyPersonController; ?>

@include('includes.image-gallery')

<div id="header" class="row">

	<!-- E80 Logo -->
	@if (Auth::check())
		<div id="logo" class="hidable">
	@else
		<div id="logo">
	@endif
		<a href="{{ route('root') }}"><img src="/resources/style/logo-elettric80.png"></a>
	</div>

	<!-- Login Ribbon -->
	@if (Auth::check())
		<div id="login_ribbon">
			<div id="thumb">				
				<img src="{!! Auth::user()->active_contact->person->profile_picture()->path() !!}">
			</div>
			<div id="info">			
				<div> <a href="{{ route('company_person.show', Auth::user()->active_contact->id) }}"> {{ Auth::user()->active_contact->person->name() }} </a> </div>
				<div> 
					@if (Session::get('debug') == true)
						
						<?php 
							$contacts = CompanyPersonController::API()->all([
								"order" => ["people.last_name","people.first_name"],
								"paginate" => "false",
								"debugger_list" => "true"
							]) 
						?>

						{!! Form::open(array('route' => array('users.switch_contact'),'id' => 'switch_company_person_form')) !!}
						{!! Form::BSSelect("switch_company_person_id", $contacts, Auth::user()->active_contact->id, ["key" => "id", "value" => ["!person.last_name"," ","!person.first_name"," @ ","!company.name"], "id" => "switch_company_person_id"]) !!}
						{!! Form::close() !!}
					@else
						{!! Form::open(array('route' => array('users.switch_contact'),'id' => 'switch_company_person_form')) !!}
						{!! Form::BSSelect("switch_company_person_id", Auth::user()->owner->company_person, Auth::user()->active_contact->id, ["key" => "id", "value" => "!company.name", "id" => "switch_company_person_id"]) !!}
						{!! Form::close() !!}
					@endif
				</div>
				<div> <a href="/logout"> Logout </a> </div>
			</div>
		</div>
	@endif

</div>