jQuery(document).ready(function($){
    // Header
    let $header = $('.site-header');
    let $scroll_to_top = $('.scroll-to-top');
    let $scroll_to_top_btn = $('.scroll-to-top button');

    if($(window).scrollTop() > $header.height()){
        if(!$header.hasClass('transparent')){
            $('body').addClass('header-fixed');
        }

        $header.addClass('fixed');
    }

    if($(window).scrollTop() > $(window).height()){
        $scroll_to_top.addClass('visible');
    }

    $(window).on('scroll', function(){
        let scroll_top = $(window).scrollTop();

        if(scroll_top > $header.height()){
            if(!$header.hasClass('transparent')){
                $('body').addClass('header-fixed');
            }
            $header.addClass('fixed');
        }
        else{
            if(!$header.hasClass('transparent')){
                $('body').removeClass('header-fixed');
            }
            $header.removeClass('fixed');
        }

        if(scroll_top > $(window).height()){
            $scroll_to_top.addClass('visible');
        }
        else{
            $scroll_to_top.removeClass('visible');
        }
    });

    $scroll_to_top_btn.on('click', function(){
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
});