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
	return \Michelf\MarkdownExtra::defaultTransform($value);
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

// 中文 4.1 文档
Route::get('docs/4-1-cn', function()
{
	Cookie::queue('docs_version', '4.1-cn', 525600);

	return Redirect::back();
});

// 中文 4.0 文档
Route::get('docs/4-0-cn', function()
{
	Cookie::queue('docs_version', '4.0-cn', 525600);

	return Redirect::back();
});

/**
 * Main Documentation Route...
 */
Route::get('docs/{page?}', function($page = null)
{
	if (is_null($page)) $page = 'introduction';
	$docPath = base_path('/docs/'.DOCS_VERSION.'/');
	// 对中文文档的支持
	ends_with(DOCS_VERSION, 'cn') AND $docPath = base_path('/docs/'.DOCS_VERSION.'/cn/');

	$file = File::get($docPath.'documentation.md');
	$file = str_replace('](/docs/', ']('.route(Route::currentRouteName()).'/', $file);
	$index = markdown($file);

	if (file_exists($path = $docPath.$page.'.md'))
	{
		$file = File::get($path);
		$file = str_replace('](/docs/', ']('.route(Route::currentRouteName()).'/', $file);
		$contents = markdown($file);
	}
	else
	{
		$contents = 'Not Found';
	}

	if ($contents == 'Not Found') return Redirect::to('docs');

	return View::make('layouts.docs', compact('index', 'contents'));
});

// 本地化 JS 文件
Route::get('js/run_prettify.js', array('as'=>'run_prettify.js', function()
{
	$path = public_path('assets/js');
	View::addNamespace('js', $path);
    return Response::view('js::run_prettify', array(), 200, array('Content-Type'=>'application/javascript'));
}));

// composer 中文文档
include __DIR__.'/docRoutes/composer.php';

// laravel 4.1 速查笔记
include __DIR__.'/docRoutes/laravel-4-1-note.php';

// PHP-PSR-代码标准中文版
include __DIR__.'/docRoutes/php-psr.php';


