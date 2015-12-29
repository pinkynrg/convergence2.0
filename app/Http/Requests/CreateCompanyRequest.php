<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateCompanyRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->can('create-company');
	}

	public function forbiddenResponse()
	{
		return redirect()->route('companies.index')->withErrors(['You are not authorized to create a new company']);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|unique:companies',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required',
            'zip_code' => 'required|numeric',
            'group_email' => 'email',
            'account_manager_id' => 'required',
            'support_type_id' => 'required',
            'account_manager_id' => 'required'
		];
	}

}
