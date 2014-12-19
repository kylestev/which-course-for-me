<?php namespace Courses\Http\Requests;

use Courses\Http\Requests\Request;

class CreateInstructorRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => [
				'required', 'unique:instructors,name'
			],
			'email' => [
				'email', 'unique:instructors,email'
			]
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
