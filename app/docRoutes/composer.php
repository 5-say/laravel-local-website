<?php
/**
 * composer 中文文档
 */
Route::get('composer-cn/{page?}', array('as'=>'composer-cn', function($page = null)
{
	if (is_null($page)) $page = 'README.md';
	$docPath = base_path('/docs/composer-doc-cn/');

	if (file_exists($path = $docPath.$page))
	{
		$file = File::get($path);
		$file = str_replace('](/', ']('.route(Route::currentRouteName()).'/', $file);
		return View::make('composer', array('contents'=>markdown($file)));
	}
	else
	{
		return Redirect::to('composer-cn');
	}
}));

Route::get('composer-cn/{path_1}/{page}', function($path_1, $page)
{
	$docPath = base_path('docs/composer-doc-cn/'.$path_1.'/');

	if (file_exists($path = $docPath.$page))
	{
		$file = File::get($path);
		$file = str_replace('](/', ']('.route('composer-cn').'/', $file);
		return View::make('composer', array('contents'=>markdown($file)));
	}
	else
	{
		return Redirect::to('composer-cn');
	}
});

Route::get('composer-cn/{path_1}/{path_2}/{page}', function($path_1, $path_2, $page)
{
	$docPath = base_path('docs/composer-doc-cn/'.$path_1.'/'.$path_2.'/');

	if (file_exists($path = $docPath.$page))
	{
		$file = File::get($path);
		$file = str_replace('](/', ']('.route('composer-cn').'/', $file);
		return View::make('composer', array('contents'=>markdown($file)));
	}
	else
	{
		return Redirect::to('composer-cn');
	}
});



