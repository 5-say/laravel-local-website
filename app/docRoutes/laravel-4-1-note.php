<?php

function analyzeMarkdown($docPath, $page, $baseRouteName)
{
    // 中文系统路径转码
    $page     = strtr($page, '>', '/');
    $docPath .= '/'.$page;
    if ($_SERVER['HTTP_ACCEPT_LANGUAGE'] == 'zh-CN')
        $docPath = iconv('UTF-8', 'GBK', $docPath);
    // 若文件不存在则返回 false
    if (! file_exists($docPath)) return false;
    // 获取文件内容
    $file = File::get($docPath);
    // 获取 md 标题信息数组
    preg_match_all('/\s(\S#+) (.+\S)/', $file, $hArray);
    // 构造本页目录
    $list = '- /'.$page.PHP_EOL;
    // 为标题添加锚记
    $search = $replace = array();
    foreach ($hArray[0] as $key => $value)
    {
        // 获取标题层级
        $len   = strlen($hArray[1][$key]);
        // 构造本页目录
        $list .= str_repeat('  ', $len).'- ['.$hArray[2][$key].'](#h'.$len.'-'.($key+1).')'.PHP_EOL;
        // 为标题添加锚记
        $search[]  = $value;
        $replace[] = '<a name="h'.$len.'-'.($key+1).'"></a>'.PHP_EOL.$value;
    }
    // 为标题添加锚记
    $file = str_replace($search, $replace, $file);
    // 变更内部链接文件夹分隔符
    $file = preg_replace_callback('/(\[.+\(\/)(.+\))/', function($matches)
    {
        return $matches[1].strtr($matches[2], '/', '>');
    }, $file);
    // 变更顶级目录 URL 指向
    $file = str_replace('](/', ']('.route($baseRouteName).'/', $file);
    // 请使用 list 函数接收返回值
    return array(markdown($list), markdown($file));
}


/**
 * laravel 4.1 速查笔记
 */

Route::group(array('prefix'=>'4.1-note'), function()
{
    $routeName    = '4.1-note';
    $docDirectory = 'laravel-4.1-note';

    Route::get('/', array('as'=>$routeName, function() use($routeName, $docDirectory)
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
            $list .= '  - [/'.$key.'](#h-'.++$i.')'.PHP_EOL;
            $contents .= '<a name="h-'.$i.'"></a>'.PHP_EOL;
            $contents .= '## /'.$key.PHP_EOL;
            foreach ($value as $vv)
            {
                $vv        = strtr($vv, '\\', '/');
                $contents .= '  - ['.str_replace($key.'/', '', $vv).']('.route($routeName).'/'.strtr($vv, '/', '>').')'.PHP_EOL;
            }
        }
        return View::make('laravel-4-1-note', array('list'=>markdown($list), 'contents'=>markdown($contents), 'active'=>'index'));
    }));
    
    Route::get('{page}', function($page) use($routeName, $docDirectory)
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
        $markdown = analyzeMarkdown($docPath, $page, $routeName);
        // 解析失败，返回起始页
        if ($markdown === false) return Redirect::route($routeName);
        // 解析成功
        list($list, $contents) = $markdown;
        $active = $page;
        return View::make('laravel-4-1-note', compact('list', 'contents', 'active'));
    });


});




