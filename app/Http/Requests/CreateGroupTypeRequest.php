<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateGroupTypeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->can('create-group-type');
	}

	public function forbiddenResponse()
	{
		return redirect()->route('group_types.index')->withErrors(['You are not authorized to create a new group type']);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|unique:group_types',
			'display_name' => 'required',
			'description' => 'required'
		];
	}

}
