<?php namespace Courses\Exceptions;

use Exception;

class APIException extends Exception {

	protected $error_code;

	protected $message;

	public function __construct($message, $error_code)
	{
		$this->message = $message;
		$this->error_code = $error_code;
	}

	public function getResponse()
	{
		$data = [
			'error_code' => $this->error_code,
			'message' => $this->message,
			'success' => false,
		];

		$content = json_encode($data, JSON_PRETTY_PRINT);

		return \Response::make($content, 200, [
			'Content-type' => 'application/json'
		]);
	}

}
