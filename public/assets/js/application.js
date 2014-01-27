jQuery(document).ready(function($) {

    // select text inputs
    $('input[type=text], textarea').focus(function() {
        $(this).select();
    });

    // toplink
    $('#top').hide();
    $(window).scroll(function(){
        if($(window).scrollTop() >= 600)
        {
            $('#top').fadeIn(500);
        }
        else
        {
            $('#top').fadeOut(500);
        }
    });

    // sticky nav
    var nav      = $('nav#primary');
    var content  = $('#content');
    var docs     = $('#docs-content');
    var navHomeY = nav.offset().top;
    var isFixed  = false;
    var $w       = $(window);

    $w.scroll(function()
    {
        var scrollTop = $w.scrollTop();
        var shouldBeFixed = scrollTop > navHomeY;
        if ( shouldBeFixed && ! isFixed )
        {
            nav.css({
                position: 'fixed',
                width: '100%',
                top: 0,
                opacity: 0.9
            });

            content.css({
                paddingTop: '75px'
            });

            docs.css({
                paddingTop: '27px',
            });

            isFixed = true;
        }
        else if ( ! shouldBeFixed && isFixed )
        {
            nav.css({
                position: 'relative',
                width: '100%',
                opacity: 1
            });

            content.css({
                paddingTop: '0'
            });

            docs.css({
                paddingTop: '27px'
            });

            isFixed = false;
        }
    });

    // make sure nav stays full width on resize
    $( window ).resize(function() {
        $( "nav#primary" ).css({ width: '100%' });
    });

    // parallax header
    $(window).scroll( function()
    {
		var scroll = $(window).scrollTop(), slowScroll = scroll/2;
		$('#header').css({ transform: "translateY(" + slowScroll + "px)" });
	});

    // footer z-index fix for ie
    $(window).scroll(function(){
        if ( $(window).scrollTop() >= 400)
        {
            $('#copyright').css({ 'z-index' : 22});
        }
        else
        {
            $('#copyright').css({ 'z-index' : 1});
        }
    });

    // quotes scroll
    var scrollSpeed = 80;
    var current = 0;
    var direction = 'h';

    function bgscroll()
    {
        current -= 1;
        $('#quotes').css("backgroundPosition", (direction == 'h') ? current+"px 0" : "0 " + current+"px");
    }
    setInterval(bgscroll, scrollSpeed);

    // quotes fade
    $('#quote > li').hide();
    $('#quote > li').fadeLoop({ fadeIn: 1000, stay: 5000, fadeOut: 500 });

    /*
    // docs drop menu
    $('#documentation nav#docs ul li').click(function(){
       $(this).find('ul:first').stop(true, true).animate({
                height: ['toggle', 'swing'],
                opacity: 'toggle'
          }, 200, 'linear');
    });
    */

    // scrolling docs nav
    /*
    var $sidebar   = $("nav#docs"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 50;

    $window.scroll(function(){
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        }
        else
        {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });
    */

    // prettyprint
    $('pre').addClass('prettyprint');

	// uniform
	$('select, input:checkbox, input:radio, input:file').uniform();

});