<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	protected function assertJsonResponse($response)
	{
		$this->assertEquals('application/json', $response->headers->get('Content-Type'));
	}

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

}
