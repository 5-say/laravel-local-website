<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Markdown Function...
 */
function markdown($value)
{
	return with(new dflydev\markdown\MarkdownExtraParser)->transformMarkdown($value);
}

/**
 * Let query string by used to force version...
 */
if (isset($_GET['v']))
{
	Cookie::queue('docs_versions', $_GET['v']);
}

/**
 * Set Docs Cookie If Not Set...
 */
if ( ! Cookie::has('docs_version'))
{
	Cookie::queue('docs_versions', '4.1');
}

if ( ! defined('DOCS_VERSION'))
{
	define('DOCS_VERSION', Cookie::get('docs_version', '4.1'));
}

/**
 * Catch A 404 On Docs...
 */
App::missing(function($e)
{
	if (Request::is('docs/*'))
	{
		return Redirect::to('docs');
	}
});

/**
 * Main Route...
 */
Route::get('/', function()
{
	return View::make('index');
});

/**
 * Documentation Routes...
 */
Route::get('docs/dev', function()
{
	Cookie::queue('docs_version', 'master', 525600);

	return Redirect::back();
});

Route::get('docs/4-0', function()
{
	Cookie::queue('docs_version', '4.0', 525600);

	return Redirect::back();
});

Route::get('docs/4-1', function()
{
	Cookie::queue('docs_version', '4.1', 525600);

	return Redirect::back();
});

/**
 * Main Documentation Route...
 */
Route::get('docs/{page?}', function($page = null)
{
	if (is_null($page)) $page = 'introduction';

	$index = Cache::remember('docs.'.DOCS_VERSION.'.index', 5, function()
	{
		return markdown(file_get_contents(base_path().'/docs/'.DOCS_VERSION.'/documentation.md'));
	});

	$contents = Cache::remember('docs.'.DOCS_VERSION.'.'.$page, 5, function() use ($page)
	{
		if (file_exists($path = base_path().'/docs/'.DOCS_VERSION.'/'.$page.'.md'))
		{
			return markdown(file_get_contents($path));
		}
		else
		{
			return 'Not Found';
		}
	});

	if ($contents == 'Not Found') return Redirect::to('docs');

	return View::make('layouts.docs', compact('index', 'contents'));
});