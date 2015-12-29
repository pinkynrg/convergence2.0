<?php namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPerson;
use App\Models\CompanyMainContact;
use App\Models\CompanyAccountManager;
use App\Models\Person;
use App\Models\User;
use App\Models\Department;
use App\Models\Title;
use App\Http\Requests\UpdatePersonRequest;
use Request;
use Auth;
use Input;
use Form;

class PeopleController extends Controller {

	public function show($id) {
		if (Auth::user()->can('read-person')) {
	        $data['menu_actions'] = [
	        	Form::editItem(route('people.edit',$id), 'Edit this person'),
				Form::deleteItem('people.destroy', $id, 'Remove this person')
	        ];
			
			$data['person'] = Person::find($id);
			$data['title'] = $data['person']->name() . " - Details";
			return view('people/show', $data);
		}
		else return redirect()->back()->withErrors(['Access denied to people show page']);
	}

	public function edit($id) {
		$data['person'] = Person::find($id);
		$data['title'] = $data['person']->name() . " - Edit";
		return view('people/edit', $data);	
	}

	public function update($id, UpdatePersonRequest $request) {
        $person = Person::find($id);
        $person->update($request->all());
        return redirect()->route('people.show',$id)->with('successes',['person updated successfully']);
	}

	public function destroy($id) {
		echo 'people destroy method to be created';
	}
}