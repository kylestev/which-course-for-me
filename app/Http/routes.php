<?php

use Courses\Repositories\Subject\SubjectRepositoryInterface;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Api', 'domain' => sprintf('api.%s', env('APP_DOMAIN'))], function ()
{
	Route::get('/', [
		'as' => 'api.root',
		'uses' => 'ApiRootController@index'
	]);

	Route::resource('instructors', 'InstructorController',
					['only' => ['index', 'show']]);

	Route::resource('section_types', 'SectionTypeController',
					['only' => ['index', 'show']]);

	Route::resource('subjects', 'SubjectController',
					['only' => ['index', 'show']]);

	Route::resource('subjects.courses', 'CourseController',
					['only' => ['index', 'show']]);

	Route::resource('subjects.courses.sections', 'SectionController',
					['only' => ['index', 'show']]);
});

Route::group(['namespace' => 'Frontend', 'domain' => env('APP_DOMAIN')], function ()
{
	Route::get('/', function (SubjectRepositoryInterface $repo)
	{
		return View::make('frontend.index')
					->with('subjects', $repo->all(), 'data');
	});

	Route::get('about', ['as' => 'frontend.about', function ()
	{
		return View::make('frontend.about');
	}]);

	Route::get('architecture', ['as' => 'frontend.architecture', function ()
	{
		return View::make('frontend.architecture');
	}]);

	Route::get('subjects', [
		'as' => 'frontend.subjects.index',
		'uses' => 'SubjectController@index'
	]);

	Route::get('subjects/{subject}/courses', [
		'as' => 'frontend.subjects.show',
		'uses' => 'SubjectController@show'
	]);

	Route::get('subjects/{subject}/courses/{course}', [
		'as' => 'frontend.courses.show',
		'uses' => 'CourseController@show'
	]);

});

Route::get('scrape', function ()
{
	Queue::push('Courses\Jobs\Scraper\ScrapeSubjects@scrape', ['term' => 'W15', 'campus' => 'corvallis']);
});
