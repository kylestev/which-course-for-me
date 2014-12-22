<?php namespace Courses\Events;

use Cache;
use Input;

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

		$page_num = (int) Input::get('page', 1);

		$cache_key = sprintf('view:cache:%s:p%d', $view->name(), $page_num);

		$content = Cache::remember($cache_key, 1, function () use ($view)
		{
			$content = $view->__toString();
			
			return preg_replace('/[\n]+/', '', $content);
		});
		// echo();
		die($content);
	}

}
