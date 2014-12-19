<?php namespace Courses\Http\Controllers\Frontend;

use Courses\Http\Controllers\Controller;

use Illuminate\Contracts\View\Factory as ViewFactory;

class FrontendController extends Controller {

	protected $layout = 'layouts.frontend';

	protected $view;

	public function __construct(ViewFactory $view)
	{
		$this->view = $view;
	}

}
