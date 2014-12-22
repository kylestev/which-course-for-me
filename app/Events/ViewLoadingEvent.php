<?php namespace Courses\Events;

use Cache;
use Input;
use Request;

class ViewLoadingEvent {

	static $seen = false;

	function handle(\Illuminate\View\View $view)
	{
		if (self::$seen)
		{
			return;
		}
		else
		{
			self::$seen = true;
		}

		// dd(Request::path());

		$page_num = (int) Input::get('page', 1);

		$cache_key = sprintf('view:cache:%s:p%d:path:%s', $view->name(), $page_num, Request::path());

		$content = Cache::remember($cache_key, 10, function () use ($view)
		{
			$content = $view->__toString();
			
			return preg_replace('/[\n]+/', '', $content);
		});

		die($content);
	}

}
