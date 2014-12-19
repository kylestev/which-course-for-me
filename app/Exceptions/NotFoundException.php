<?php namespace Courses\Exceptions;

class NotFoundException extends APIException {

	public function __construct($message = 'Object not found')
	{
		parent::__construct($message, 404);
	}

}
