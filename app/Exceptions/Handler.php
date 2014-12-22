<?php namespace Courses\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if ($e instanceof APIException)
		{
			if (str_is('*api.*', $request->url()))
			{
				return $e->getResponse();
			}
			else
			{
				$content = view('errors.404', [
					'error' => $e,
				]);

				return \Response::make($content, 200);
			}
		}
		elseif ($this->isHttpException($e))
		{
			if (str_is('*api.*', $request->url()))
			{
				$content = [
					'error' => $e->getMessage(),
					'code' => $e->getStatusCode(),
				];

				$code = $e->getStatusCode();
				$message = 'An unknown error has occurred!';

				if ($code == 404)
				{
					$message = 'Resource not found';
				}

				throw new APIException($message, $code);
			}

			return $this->renderHttpException($e);
		}

		return parent::render($request, $e);
	}

}
