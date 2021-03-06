<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'root', function () {
	return Auth::check() ? redirect()->route('tickets.index') : redirect()->route('public.helpdesk');
}]);

Route::group(array('middleware' => ['auth','log']), function() {

	Route::get('/debug/enable', function () {
		if (Auth::user()->owner->id == ADMIN_PERSON_ID) {
			Session::set("debug",true); 
		}
		return redirect()->route('root');
	});

	Route::get('/debug/disable', function () {
		if (Auth::user()->owner->id == ADMIN_PERSON_ID) {
			Session::set("debug",false);
		}
		return redirect()->route('root');
	});

	Route::get('API/group-types/{method}',['uses' => 'GroupTypesController@apiCall', 'as' => 'group_types.api']);
	Route::get('API/groups/{method}',['uses' => 'GroupsController@apiCall', 'as' => 'groups.api']);	
	Route::get('API/roles/{method}',['uses' => 'RolesController@apiCall', 'as' => 'roles.api']);	
	Route::get('API/escalation-profiles/{method}',['uses' => 'EscalationProfilesController@apiCall', 'as' => 'escalation_profiles.api']);	
	Route::get('API/permissions/{method}',['uses' => 'PermissionsController@apiCall', 'as' => 'permissions.api']);
	Route::get('API/companies/{method}',['uses' => 'CompaniesController@apiCall', 'as' => 'companies.api']);
	Route::get('API/tickets/{method}',['uses' => 'TicketsController@apiCall', 'as' => 'tickets.api']);
	Route::get('API/statuses/{method}',['uses' => 'StatusesController@apiCall', 'as' => 'statuses.api']);
	Route::get('API/priorities/{method}',['uses' => 'PrioritiesController@apiCall', 'as' => 'priorities.api']);
	Route::get('API/posts/{method}',['uses' => 'PostsController@apiCall', 'as' => 'posts.api']);
	Route::get('API/equipment/{method}',['uses' => 'EquipmentController@apiCall', 'as' => 'equipment.api']);
	Route::get('API/services/{method}',['uses' => 'ServicesController@apiCall', 'as' => 'services.api']);
	Route::get('API/people/{method}',['uses' => 'PeopleController@apiCall', 'as' => 'people.api']);
	Route::get('API/users/{method}',['uses' => 'UsersController@apiCall', 'as' => 'users.api']);
	Route::get('API/contacts/{method}',['uses' => 'CompanyPersonController@apiCall', 'as' => 'contacts.api']);
	Route::get('API/hotels/{method}',['uses' => 'HotelsController@apiCall', 'as' => 'hotels.api']);

	// group_types routes 
	Route::get('group-types',['uses' => 'GroupTypesController@index', 'as' => 'group_types.index']);
	Route::get('group-types/create',['uses' => 'GroupTypesController@create', 'as' => 'group_types.create']);
	Route::get('group-types/{id}',['uses' => 'GroupTypesController@show', 'as' => 'group_types.show']);
	Route::post('group-types', ['uses' => 'GroupTypesController@store', 'as' => 'group_types.store']);
	Route::delete('group-types/{id}', ['uses' => 'GroupTypesController@destroy', 'as' => 'group_types.destroy']);
	Route::patch('group-types/{id}', ['uses' => 'GroupTypesController@update', 'as' => 'group_types.update']);	
	Route::get('group-types/{id}/edit', ['uses' => 'GroupTypesController@edit', 'as' => 'group_types.edit']);

	// groups routes 
	Route::get('groups',['uses' => 'GroupsController@index', 'as' => 'groups.index']);
	Route::get('groups/create',['uses' => 'GroupsController@create', 'as' => 'groups.create']);
	Route::get('groups/{id}',['uses' => 'GroupsController@show', 'as' => 'groups.show']);
	Route::post('groups', ['uses' => 'GroupsController@store', 'as' => 'groups.store']);
	Route::delete('groups/{id}', ['uses' => 'GroupsController@destroy', 'as' => 'groups.destroy']);
	Route::patch('groups/{id}', ['uses' => 'GroupsController@update', 'as' => 'groups.update']);	
	Route::get('groups/{id}/edit', ['uses' => 'GroupsController@edit', 'as' => 'groups.edit']);
	Route::post('groups/{id}/roles', ['uses' => 'GroupsController@updateGroupRoles', 'as' => 'groups.update_roles']);

	// roles routes 
	Route::get('roles',['uses' => 'RolesController@index', 'as' => 'roles.index']);
	Route::get('roles/create',['uses' => 'RolesController@create', 'as' => 'roles.create']);
	Route::get('roles/{id}',['uses' => 'RolesController@show', 'as' => 'roles.show']);
	Route::post('roles', ['uses' => 'RolesController@store', 'as' => 'roles.store']);
	Route::delete('roles/{id}', ['uses' => 'RolesController@destroy', 'as' => 'roles.destroy']);
	Route::patch('roles/{id}', ['uses' => 'RolesController@update', 'as' => 'roles.update']);	
	Route::get('roles/{id}/edit', ['uses' => 'RolesController@edit', 'as' => 'roles.edit']);
	Route::post('roles/{id}/permissions', ['uses' => 'RolesController@updateRolePermissions', 'as' => 'roles.update_permissions']);

	// escalation_profiles routes
	Route::get('escalation-profiles',['uses' => 'EscalationProfilesController@index', 'as' => 'escalation_profiles.index']);
	Route::get('escalation-profiles/create',['uses' => 'EscalationProfilesController@create', 'as' => 'escalation_profiles.create']);
	Route::get('escalation-profiles/{id}/edit', ['uses' => 'EscalationProfilesController@edit', 'as' => 'escalation_profiles.edit']);
	Route::get('escalation-profiles/{id}/{num?}',['uses' => 'EscalationProfilesController@show', 'as' => 'escalation_profiles.show']);
	Route::post('escalation-profiles', ['uses' => 'EscalationProfilesController@store', 'as' => 'escalation_profiles.store']);
	Route::delete('escalation-profiles/{id}', ['uses' => 'EscalationProfilesController@destroy', 'as' => 'escalation_profiles.destroy']);
	Route::patch('escalation-profiles/{id}', ['uses' => 'EscalationProfilesController@update', 'as' => 'escalation_profiles.update']);	
	Route::post('escalation-profiles/{id}/events', ['uses' => 'EscalationProfilesController@updateProfileEvents', 'as' => 'escalation_profiles.update_events']);

	// permissions routes 
	Route::get('permissions',['uses' => 'PermissionsController@index', 'as' => 'permissions.index']);
	Route::get('permissions/create',['uses' => 'PermissionsController@create', 'as' => 'permissions.create']);
	Route::get('permissions/{id}',['uses' => 'PermissionsController@show', 'as' => 'permissions.show']);
	Route::post('permissions', ['uses' => 'PermissionsController@store', 'as' => 'permissions.store']);
	Route::delete('permissions/{id}', ['uses' => 'PermissionsController@destroy', 'as' => 'permissions.destroy']);
	Route::patch('permissions/{id}', ['uses' => 'PermissionsController@update', 'as' => 'permissions.update']);	
	Route::get('permissions/{id}/edit', ['uses' => 'PermissionsController@edit', 'as' => 'permissions.edit']);

	// companies routes 
	Route::get('companies',['uses' => 'CompaniesController@index', 'as' => 'companies.index']);
	Route::get('companies/create',['uses' => 'CompaniesController@create', 'as' => 'companies.create']);
	Route::get('companies/{id}',['uses' => 'CompaniesController@show', 'as' => 'companies.show']);
	Route::post('companies', ['uses' => 'CompaniesController@store', 'as' => 'companies.store']);
	Route::delete('companies/{id}', ['uses' => 'CompaniesController@destroy', 'as' => 'companies.destroy']);
	Route::patch('companies/{id}', ['uses' => 'CompaniesController@update', 'as' => 'companies.update']);	
	Route::get('companies/{id}/edit', ['uses' => 'CompaniesController@edit', 'as' => 'companies.edit']);
	Route::get('companies/{id}/contacts', ['uses' => 'CompaniesController@contacts', 'as' => 'companies.contacts']);
	Route::get('companies/{id}/tickets', ['uses' => 'CompaniesController@tickets', 'as' => 'companies.tickets']);
	Route::get('companies/{id}/equipment', ['uses' => 'CompaniesController@equipment', 'as' => 'companies.equipment']);
	Route::get('companies/{id}/hotels', ['uses' => 'CompaniesController@hotels', 'as' => 'companies.hotels']);
	Route::get('companies/{id}/services', ['uses' => 'CompaniesController@services', 'as' => 'companies.services']);
	Route::get('my-company',['uses' => 'CompaniesController@myCompany', 'as' => 'companies.my_company']);

	// tickets request route
	Route::get('ticket-requests/create',['uses' => 'TicketRequestsController@create', 'as' => 'ticket_requests.create']);
	Route::post('ticket-requests/draft',['uses' => 'TicketRequestsController@draft', 'as' => 'ticket_requests.draft']);
	Route::post('tickets-requests', ['uses' => 'TicketRequestsController@store', 'as' => 'tickets-requests.store']);

	// tickets routes 
	Route::get('tickets',['uses' => 'TicketsController@index', 'as' => 'tickets.index']);
	Route::get('tickets/request',['uses' => 'TicketsController@create', 'as' => 'tickets.request']);
	Route::get('tickets/create',['uses' => 'TicketsController@create', 'as' => 'tickets.create']);
	Route::get('tickets/{id}',['uses' => 'TicketsController@show', 'as' => 'tickets.show']);
	Route::post('tickets', ['uses' => 'TicketsController@store', 'as' => 'tickets.store']);
	Route::post('tickets/draft', ['uses' => 'TicketsController@draft', 'as' => 'tickets.draft']);
	Route::delete('tickets/{id}', ['uses' => 'TicketsController@destroy', 'as' => 'tickets.destroy']);
	Route::patch('tickets/{id}', ['uses' => 'TicketsController@update', 'as' => 'tickets.update']);	
	Route::get('tickets/{id}/edit', ['uses' => 'TicketsController@edit', 'as' => 'tickets.edit']);

	// posts routes
	Route::post('posts',['uses' => 'PostsController@store', 'as' => 'posts.store']);
	Route::post('posts/draft',['uses' => 'PostsController@draft', 'as' => 'posts.draft']);
	Route::get('posts/{id}',['uses' => 'PostsController@show', 'as' => 'posts.show']);
	Route::patch('posts/{id}',['uses' => 'PostsController@update', 'as' => 'posts.update']);
	Route::get('posts/{id}/edit', ['uses' => 'PostsController@edit', 'as' => 'posts.edit']);

	// equipment routes 
	Route::get('equipment',['uses' => 'EquipmentController@index', 'as' => 'equipment.index']);
	Route::get('equipment/create/{company_id}',['uses' => 'EquipmentController@create', 'as' => 'equipment.create']);
	Route::get('equipment/{id}',['uses' => 'EquipmentController@show', 'as' => 'equipment.show']);
	Route::post('equipment', ['uses' => 'EquipmentController@store', 'as' => 'equipment.store']);
	Route::delete('equipment/{id}', ['uses' => 'EquipmentController@destroy', 'as' => 'equipment.destroy']);
	Route::patch('equipment/{id}', ['uses' => 'EquipmentController@update', 'as' => 'equipment.update']);	
	Route::get('equipment/{id}/edit', ['uses' => 'EquipmentController@edit', 'as' => 'equipment.edit']);

	// vpns routes 
	Route::get('vpns',['uses' => 'VpnsController@index', 'as' => 'vpns.index']);
	Route::get('vpns/create',['uses' => 'VpnsController@create', 'as' => 'vpns.create']);
	Route::get('vpns/{id}',['uses' => 'VpnsController@show', 'as' => 'vpns.show']);
	Route::post('vpns', ['uses' => 'VpnsController@store', 'as' => 'vpns.store']);
	Route::delete('vpns/{id}', ['uses' => 'VpnsController@destroy', 'as' => 'vpns.destroy']);
	Route::patch('vpns/{id}', ['uses' => 'VpnsController@update', 'as' => 'vpns.update']);	
	Route::get('vpns/{id}/edit', ['uses' => 'VpnsController@edit', 'as' => 'vpns.edit']);

	// services routes 
	Route::get('services',['uses' => 'ServicesController@index', 'as' => 'services.index']);
	Route::get('services/create/{company_id}/{technician_number?}',['uses' => 'ServicesController@create', 'as' => 'services.create']);
	Route::get('services/{id}',['uses' => 'ServicesController@show', 'as' => 'services.show']);
	Route::post('services', ['uses' => 'ServicesController@store', 'as' => 'services.store']);
	Route::delete('services/{id}', ['uses' => 'ServicesController@destroy', 'as' => 'services.destroy']);
	Route::patch('services/{id}', ['uses' => 'ServicesController@update', 'as' => 'services.update']);	
	Route::get('services/{id}/edit', ['uses' => 'ServicesController@edit', 'as' => 'services.edit']);
	Route::get('services/pdf/{id}',['uses' => 'ServicesController@pdf', 'as' => 'services.pdf']);
	Route::get('services/generate/pdf/{id}', ['uses' => 'ServicesController@generatePdf', 'as' => 'services.generate_pdf']);

	// people routes
	Route::get('people/{id}',['uses' => 'PeopleController@show', 'as' => 'people.show']);
	Route::delete('people/{id}', ['uses' => 'PeopleController@destroy', 'as' => 'people.destroy']);
	Route::patch('people/{id}', ['uses' => 'PeopleController@update', 'as' => 'people.update']);
	Route::get('people/{id}/edit', ['uses' => 'PeopleController@edit', 'as' => 'people.edit']);

	// users routes
	Route::post('users/switch-contact',['uses' => 'UsersController@switchCompanyPerson', 'as' => 'users.switch_contact']);
	Route::get('users',['uses' => 'UsersController@index', 'as' => 'users.index']);
	Route::get('users/create/{id?}', ['uses' => 'UsersController@create', 'as' => 'users.create']);
	Route::post('users', ['uses' => 'UsersController@store', 'as' => 'users.store']);
	Route::patch('users/{id}', ['uses' => 'UsersController@update', 'as' => 'users.update']);
	Route::get('users/{id}/edit', ['uses' => 'UsersController@edit', 'as' => 'users.edit']);

	// company_person
	Route::get('contacts',['uses' => 'CompanyPersonController@index', 'as' => 'company_person.index']);
	Route::get('contacts/create/{company_id?}', ['uses' => 'CompanyPersonController@create', 'as' => 'company_person.create']);
	Route::post('people', ['uses' => 'CompanyPersonController@store', 'as' => 'company_person.store']);
	Route::get('contacts/{company_person_id}',['uses' => 'CompanyPersonController@show', 'as' => 'company_person.show']);
	Route::get('contacts/{company_person_id}/edit', ['uses' => 'CompanyPersonController@edit', 'as' => 'company_person.edit']);
	Route::patch('contacts/{company_person_id}', ['uses' => 'CompanyPersonController@update', 'as' => 'company_person.update']);
	Route::delete('contacts/{company_person_id}', ['uses' => 'CompanyPersonController@destroy', 'as' => 'company_person.destroy']);
	Route::get('contacts/{id}/assigneeTickets', ['uses' => 'CompanyPersonController@assigneeTickets', 'as' => 'company_person.assignee_tickets']);
	Route::get('contacts/{id}/divisionTickets', ['uses' => 'CompanyPersonController@divisionTickets', 'as' => 'company_person.division_tickets']);
	Route::get('contacts/{id}/contactTickets', ['uses' => 'CompanyPersonController@contactTickets', 'as' => 'company_person.contact_tickets']);
	Route::get('contacts/{id}/companyTickets', ['uses' => 'CompanyPersonController@companyTickets', 'as' => 'company_person.company_tickets']);

	// activities routes
	Route::get('activities',['uses' => 'ActivitiesController@index', 'as' => 'activities.index']);

	// statistics
	Route::match(['get'], 'dashboard', ['uses' => 'DashboardController@dashboardLoggedContact', 'as' => 'dashboard.logged']);
	Route::match(['get'], 'dashboard/{contact_id}', ['uses' => 'DashboardController@dashboardContact', 'as' => 'dashboard.show']);
	Route::get('statistics/status-count-to-date', ['uses' => 'StatisticsController@statusCountToDate', 'as' => 'statistics.history_status_count_to_date']);
	Route::get('statistics/status-count-per-day', ['uses' => 'StatisticsController@statusCountPerDay', 'as' => 'statistics.history_status_count_per_date']);
	Route::get('statistics/working-time-by-division/{days?}', ['uses' => 'StatisticsController@workingTimeByDivision', 'as' => 'statistics.working_time_by_division']);
	Route::get('statistics/working-time-by-customer/{days?}', ['uses' => 'StatisticsController@workingTimeByCustomer', 'as' => 'statistics.working_time_by_customer']);
	Route::get('statistics/working-time-by-assignee/{days?}', ['uses' => 'StatisticsController@workingTimeByAssignee', 'as' => 'statistics.working_time_by_assignee']);

	// customer site pages controller
	Route::get('training', array('uses' => 'CustomerSiteController@training', 'as' => 'public.training'));
	Route::get('products', array('uses' => 'CustomerSiteController@products', 'as' => 'public.products'));

	// attachments
	Route::post('files', ['uses' => 'FilesController@upload', 'as' => 'files.upload']);
	Route::delete('files/{id}', ['uses' => 'FilesController@destroy', 'as' => 'files.destroy']);

	// ajax routes
	Route::get('ajax/tags', ['uses' => 'TagsController@ajaxTagsRequest', 'as' => 'ajax.tags']);	
	Route::get('ajax/people', ['uses' => 'CompanyPersonController@ajaxPeopleRequest', 'as' => 'ajax.people']);
	Route::get('ajax/tickets/contacts/{company_id}', ['uses' => 'TicketsController@ajaxContactsRequest', 'as' => 'json.tickets.contacts']);
	Route::get('ajax/tickets/equipment/{company_id}', ['uses' => 'TicketsController@ajaxEquipmentRequest', 'as' => 'json.tickets.equipment']);
	Route::get('ajax/files/{target}/{target_action}/{id}', ['uses' => 'FilesController@listFiles', 'as' => 'files.list']);
	Route::post('ajax/markdown', ['uses' => 'MarkdownController@toHtml', 'as' => 'markdown.html']);

});

Route::get('helpdesk', array('uses' => 'CustomerSiteController@helpdesk', 'as' => 'public.helpdesk'));
Route::get('login', array('uses' => 'LoginController@showLogin', 'as' => 'login.index'));
Route::post('login', array('uses' => 'LoginController@doLogin', 'as' => 'login.login'));
Route::get('logout', array('uses' => 'LoginController@doLogout', 'as' => 'login.logout'));
Route::get('start',['uses' => 'LoginController@start', 'as' => 'login.start']);
Route::post('start',['uses' => 'LoginController@storeInfo', 'as' => 'login.store_info']);
Route::get('files/{id}',['uses' => 'FilesController@show', 'as' => 'files.show']);

Route::any('{any}', function($any) {
	return redirect()->back()->withErrors(["Ops... the requested page couldn't be found!"]);
})->where('any', '(.*)?');

?>