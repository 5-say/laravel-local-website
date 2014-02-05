<?php
$is_active = function($name='') use($active)
{
    if ($active===$name)
        return ' class="current-item"';
    else
        return '';
}
?>
<!doctype html>

<html lang="en">

<head>
    <title>PHP-PSR-代码标准中文版</title>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
    <meta name="author" content="iKreativ">
    <meta name="description" content="Laravel - The PHP framework for web artisans.">
    <meta name="keywords" content="laravel, php, framework, web, artisans, taylor otwell">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.png?v=2') }}">

    <!-- we're minifying and combining all our css -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">

    <!-- grab jquery from google cdn. fall back to local if offline -->
    <script src="{{ asset('/') }}assets/js/jquery.js"></script>

    <!-- prettyprint -->
    <script src="{{ route('run_prettify.js') }}"></script>

    <!-- load up our js -->
    <script src="{{ asset('/') }}assets/js/plugins.js"></script>
    <script src="{{ asset('/') }}assets/js/application.js"></script>

    <!-- fonts -->
    <link href="{{ asset('/') }}assets/css/source-sans-pro-n3-i3-n4-i4-n6-i6-n7-i7.js.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/css/source-code-pro.js.css" rel="stylesheet">

    <!-- some conditionals for ie -->
    <!--[if IE]><link href="{{ asset('/') }}assets/css/ie.css" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- HTML5 elements in less than IE9, yes please! -->
    <!--[if lt IE 9]><script src="{{ asset('/') }}assets/js/html5.js"></script><![endif]-->

    <!-- If less than IE8 add some JS for the webfont icons -->
    <!--[if lt IE 8]><script src="{{ asset('/') }}assets/js/ie_font.js"></script><![endif]-->

    <link href="{{ asset('/') }}assets/bootstrap-3.0.3/modals/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('/') }}assets/bootstrap-3.0.3/modals/js/bootstrap.min.js"></script>
    <style>
        nav#primary ul {
            margin-top:-23px;
        }
        #documentation #docs-content blockquote {
            width: 883px;
        }
        #documentation #docs-content ul {
            padding: 0 0 1em 2em;
        }
        #documentation code {
            font-size: 0.5em;
            font-weight: normal;
        }
        #documentation strong {
            color: #E72A50;
        }
        #documentation table th {
            background-color: #f7f7f7;
        }
        #documentation table td {
            line-height: 1.5em;
            background-color: #f3f3f3;
        }
        #documentation li p {
            margin-bottom: 1em;
            padding-left: 1em;
            margin-top: -1.5em;
        }
        #documentation blockquote p strong {
            color: #333;
        }
        #documentation img {
            max-width: 100%;
        }
    </style>
</head>

<body id="index" class="page docs">

    <!-- wrapper -->
    <div id="wrapper">

        <!-- header -->
        <header id="header" role="header" style="height:3em;">
            <div class="boxed">
                <!-- tagline -->
                <div id="tagline" style="padding-top:0;">
                    <h1 style="line-height:0.5em;">
                        PHP-PSR-代码标准中文版
                    </h1>
                </div>
                <!-- /tagline -->

                <!-- version -->
                <div id="version">
                    <ul class="nolist">
                        <li><a target="_blank" href="https://github.com/hfcorriez/fig-standards" title="Dev">Github</a></li>
                    </ul>
                </div>
                <!-- /version -->
            </div>
        </header>
        <!-- /header -->

        <!-- nav -->
        <nav id="primary" style="height:1.5em;">
            <div class="boxed">
                <ul>
                    <li><a href="{{ route('get /') }}">Welcome</a></li>
                    <li{{ $is_active('README.md') }}><a href="{{ route('psr') }}/README.md">readme.md</a></li>
                    <li{{ $is_active('index') }}><a href="{{ route('psr') }}">索引</a></li>
                    <li style="margin-left:1em; padding-top:0.8em;">
                        <button type="button" style="padding:0.2em 0.5em;background-color:#EB706B;"
                            data-toggle="modal" data-target="#myModal">Menu</button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /nav -->

        <!-- content -->
        <div id="content">

            <!-- docs -->
            <section id="documentation">
                <article class="boxed">
                    <!-- docs content -->
                    <div id="docs-content" style="width:924px;">
                        {{ $contents }}
                    </div>
                    <!-- /docs content -->

                </article>
            </section>
            <!-- /docs -->

        </div>
        <!-- /content -->

        <!-- footer -->
        <footer id="foot" class="textcenter">
            <div class="boxed">

                <!-- nav -->
                <nav id="secondary">
                    <div id="logo-foot">
                       <a href="{{ route('get /') }}"><img src="{{ asset('/') }}assets/img/logo-foot.png" alt="Laravel" /></a>
                    </div>
                    <ul>
                        <li><a href="{{ route('get /') }}">Welcome</a></li>
                        <li class="current-item"><a href="docs" title="Documentation">Documentation</a></li>
                        <li><a href="api/{{ DOCS_VERSION }}" title="Laravel Framework API">API</a></li>
                        <li><a href="https://github.com/laravel/laravel" title="Github">Github</a></li>
                        <li><a href="http://forums.laravel.io/" title="Laravel Forums">Forums</a></li>
                        <li><a href="http://twitter.com/laravelphp" title="Laravel on Twitter">Twitter</a></li>
                    </ul>
                </nav>
                <!-- /nav -->

            </div>
        </footer>
        <!-- /footer -->

        <!-- to the top -->
        <div id="top">
            <a href="#index" title="Back to the top">
                <i class="icon-chevron-up"></i>
            </a>
        </div>
        <!-- /to the top -->

    </div>
    <!-- /wrapper -->

    <!-- copyright -->
    <section id="copyright" class="textcenter">
        <div class="boxed">
            <div class="animated slideInLeft">Laravel is a trademark of Taylor Otwell. Copyright &copy; <a href="http://twitter.com/taylorotwell" title="Taylor Otwell" target="_blank">Taylor Otwell</a>. Website built with &hearts; <a href="//ikreativ.com" title="iKreativ" target="_blank">iKreativ</a>.</div>
        </div>
    </section>
    <!-- /copyright -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="padding:2em;">
            {{ $list }}
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>
</html>
