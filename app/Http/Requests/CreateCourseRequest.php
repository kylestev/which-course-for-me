<?php namespace Courses\Http\Requests;

use Courses\Http\Requests\Request;

class CreateCourseRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id' => [
				'required', 'exists:subjects,id'
			],
			'level' => [
				'required', 'integer'
			],
			'title' => [
				'required'
			],
			'description' => [
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
