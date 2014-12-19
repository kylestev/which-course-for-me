<?php namespace Courses\Http\Requests;

use Courses\Http\Requests\Request;

class CreateSubjectRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'subjcode' => [
				'required', 'alpha', 'unique:subjects,subjcode'
			],
			'name' => [
				'required'
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
