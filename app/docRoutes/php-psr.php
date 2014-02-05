<?php

/**
 * PHP-PSR-代码标准中文版
 */

Route::group(array('prefix'=>'psr'), function()
{
    $routeName    = 'psr';
    $docDirectory = 'fig-standards';
    $view         = 'psr';

    Route::get('/', array('as'=>$routeName, function() use($routeName, $docDirectory, $view)
    {
        // 读取目录文件信息
        $allFiles = File::allFiles(base_path('docs/'.$docDirectory));
        // 格式化为二维数组
        $allFilesArray = array();
        if ($_SERVER['HTTP_ACCEPT_LANGUAGE'] == 'zh-CN')
        {
            foreach ($allFiles as $key => $value)
            {
                $path = $value->getRelativePath();
                $name = $value->getRelativePathname();
                $path = iconv('GBK', 'UTF-8', $path);
                $name = iconv('GBK', 'UTF-8', $name);
                $allFilesArray[$path][] = $name;
            }
        }
        else
        {
            foreach ($allFiles as $key => $value)
            {
                $path = $value->getRelativePath();
                $name = $value->getRelativePathname();
                $allFilesArray[$path][] = $name;
            }
        }
        // 构造目录列表、索引文件
        $list     = '- 目录'.PHP_EOL;
        $contents = '# 项目索引';
        $i        = 0;
        foreach ($allFilesArray as $key => $value)
        {
            if (starts_with($key, 'img')) continue; // 忽略图片目录（递归）
            if ($key === '') continue;              // 忽略根目录（非递归）
            $key   = strtr($key, '\\', '/');
            $list .= '  - ['.$key.'](#h-'.++$i.')'.PHP_EOL;
            $contents .= '<a name="h-'.$i.'"></a>'.PHP_EOL;
            $contents .= '## '.$key.PHP_EOL;
            foreach ($value as $vv)
            {
                $vv        = strtr($vv, '\\', '/');
                $contents .= '  - ['.str_replace($key.'/', '', $vv).']('.route($routeName).'/'.strtr($vv, '/', '>').')'.PHP_EOL;
            }
        }
        return View::make($view, array('list'=>markdown($list), 'contents'=>markdown($contents), 'active'=>'index'));
    }));
    
    Route::get('{page}', function($page) use($routeName, $docDirectory, $view)
    {
        // 构造文件路径
        $docPath  = base_path('docs/'.$docDirectory);
        // 图片文件处理
        if (! ends_with($page, '.md'))
        {
            $imgPath = $docPath.'/'.strtr($page, '>', '/');
            if (file_exists($imgPath))
                return Response::make(File::get($imgPath))->header('Content-Type', 'image/'.File::extension($imgPath));
            else
                return Redirect::route($routeName);
        }
        // 解析 md 文件
        $markdown = analyzeMarkdown($docPath, $page, $routeName, function($file){
            // 额外修正的项目根目录链接
            $file = str_replace(
                'https://github.com/hfcorriez/fig-standards/blob/zh_CN/',
                '/',
                $file
            );
        });
        // 解析失败，返回起始页
        if ($markdown === false) return Redirect::route($routeName);
        // 解析成功
        list($list, $contents) = $markdown;
        // 返回视图响应
        $active = $page;
        return View::make($view, compact('list', 'contents', 'active'));
    });


});




