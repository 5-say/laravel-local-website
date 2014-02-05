@extends('layouts.master')

@section('content')
<!-- header -->
<header id="header" role="header">
    <div class="boxed">
        <!-- tagline -->
        <div id="tagline" class="animated bounceInUp">
            <h1>The PHP Framework For Web Artisans.</h1>
            <h2>PHP That Doesn't Hurt. Code Happy & Enjoy The Fresh Air.</h2>
        </div>
        <!-- /tagline -->

        <!-- callto action -->
        <div id="callto" class="animated bounceInLeft">
            <a href="docs/quick" class="button large animated shake">Quickstart</a>
            <a href="{{ route('4.1-note') }}" class="button large animated shake">4.1-note</a>
            <a href="{{ route('composer-cn') }}" class="button large animated shake">composer</a>
            <a href="{{ route('psr') }}" class="button large animated shake">PSR</a>
        </div>
        <!-- /callto action -->

        <!-- ui -->
        <div class="animated fadeIn" id="header_image" style="background: url(assets/img/sublime.png) top center no-repeat;"></div>
        <!-- /ui -->
    </div>
</header>
<!-- /header -->

<!-- nav -->
<nav id="primary">
    <div class="boxed">
        <div id="logo-head">
           <a href="//laravel.com"><img src="assets/img/logo-head.png" alt="Laravel" /></a>
        </div>
        <ul>
            <li class="current-item"><a href="#">Welcome</a></li>
            <li><a href="docs" title="Documentation">Documentation</a></li>
            <li><a href="api/{{ DOCS_VERSION }}" title="Laravel Framework API">API</a></li>
            <li><a href="//github.com/laravel/laravel" title="Github">Github</a></li>
            <li><a href="//forums.laravel.io/" title="Laravel Forums">Forums</a></li>
            <li><a href="//twitter.com/laravelphp" title="Laravel on Twitter">Twitter</a></li>
        </ul>
    </div>
</nav>
<!-- /nav -->

<!-- content -->
<div id="content">

    <!-- page -->
    <section id="page">
        <article class="boxed">
            <ul class="feature-box nolist">
                <li class="one_quarter">
                    <h2><i class="icon-random"></i> <a title="RESTful Routing" href="docs/routing">RESTful Routing</a></h2>
                    <p>Use simple Closures to respond to requests to your application. It couldn't be easier to get started building amazing applications.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-graph"></i> <a title="Command Your Data" href="docs/eloquent">Command Your Data</a></h2>
                    <p>Ships with the amazing Eloquent ORM and a great migration system. Works great on MySQL, Postgres, SQL Server, and SQLite.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-pencil-alt"></i> <a title="Beautiful Templating" href="docs/templates">Beautiful Templating</a></h2>
                    <p>Use native PHP or the light-weight Blade templating engine. Blade provides great template inheritance and is blazing fast. You'll love it.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-time"></i> <a title="Ready For Tomorrow" href="docs/routing">Ready For Tomorrow</a></h2>
                    <p>Build huge enterprise applications, or simple JSON APIs. Write powerful controllers, or slim RESTful routes. Laravel is perfect for jobs of all sizes.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-cog"></i> <a title="Proven Foundation" href="http://www.symfony.com">Proven Foundation</a></h2>
                    <p>Laravel is built on top of several Symfony components, giving your application a great foundation of well-tested and reliable code.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-star"></i> <a title="Composer Powered" href="http://getcomposer.org">Composer Powered</a></h2>
                    <p>Composer is an amazing tool to manage your application's third-party packages. Find packages on Packagist and use them in seconds.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-group"></i> <a title="Great Community" href="http://forums.laravel.io">Great Community</a></h2>
                    <p>Whether you're a PHP beginner or architecture astronaut, you'll fit right in. Discuss ideas in the IRC chat room, or post questions in the forum.</p>
                </li>
                <li class="one_quarter">
                    <h2><i class="icon-wrench"></i> <a title="Red, Green, Refactor" href="docs/testing">Red, Green, Refactor</a></h2>
                    <p>Laravel is built with testing in mind. Stay flexible with the IoC container, and run your tests with PHPUnit. Don't worry... it's easier than you think.</p>
                </li>
            </ul>
        </article>
    </section>
    <!-- /page -->

</div>
<!-- /content -->

<!-- sponsors -->
<section id="sponsors">
   <article class="boxed">
	   <ul id="sponsor" class="nolist textcenter aligncenter">
	       <li class="animated fadeInDown">
	           <div class="sponsor">
	               <p>Laravel community sponsor Cartalyst is the leader in premium add-ons and extensions to the Laravel framework. Their arsenal of high quality components will take your application to the next level.</p>
	           </div>
	           <div class="sponsor-logo">
	               <a href="//cartalyst.com" title="Cartalyst" target="_blank">
	                   <img src="assets/img/sponsors/cartalyst.png" alt="Cartalyst" />
	               </a>
	           </div>
	       </li>
	   </ul>
   </article>
</section>
<!-- /sponsors -->

<!-- quotes -->
<section id="quotes">
   <article class="boxed">
       <ul id="quote" class="nolist textcenter aligncenter">
           <li class="animated flipInX">
               <div class="quote"><p>Laravel has changed my life. The best framework to quickly turn an idea into product.</p></div>
               <div class="person">Maksim Surguy</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Laravel reignited my passion for code, reinforced my understanding of MVC, and made development fun again!</p></div>
               <div class="person">Jozef Maxted</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Laravel kept me from leaving PHP.</p></div>
               <div class="person">Michael Hasselbring</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Laravel helped me stop reinventing the wheel!</p></div>
               <div class="person">Ryan McDonough</div>
           </li>
       </ul>
   </article>
</section>
<!-- /quotes -->

<!-- footer -->
<footer id="foot" class="textcenter">
    <div class="boxed">

        <!-- nav -->
        <nav id="secondary">
            <div id="logo-foot">
	           <a href="//laravel.com"><img src="assets/img/logo-foot.png" alt="Laravel" /></a>
	        </div>
            <ul>
                <li class="current-item"><a href="#">Welcome</a></li>
                <li><a href="docs" title="Documentation">Documentation</a></li>
                <li><a href="api/{{ DOCS_VERSION }}" title="Laravel Framework API">API</a></li>
                <li><a href="//github.com/laravel/laravel" title="Github">Github</a></li>
                <li><a href="//forums.laravel.io/" title="Laravel Forums">Forums</a></li>
                <li><a href="//twitter.com/laravelphp" title="Laravel on Twitter">Twitter</a></li>
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
@endsection