jQuery(document).ready(function($){
    // Header
    let $header = $('.site-header');

    let $header_action_btn = $('.menu-item-type-action a');

    let $scroll_to_top = $('.scroll-to-top');
    let $scroll_to_top_btn = $('.scroll-to-top button');

    let $mobile_nav_toggler = $('.site-nav__toggler');

    let $hero_form_toggler = $('a[href="#form"]');

    let $chat_toggler = $('a[href="#chat"]');

    if($(window).scrollTop() > $header.height()){
        if(!$header.hasClass('transparent')){
            $('body').addClass('header-fixed');
        }
        $header.addClass('fixed');
        $header_action_btn.removeClass('button--outline');
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
            $header_action_btn.removeClass('button--outline');
        }
        else{
            if(!$header.hasClass('transparent')){
                $('body').removeClass('header-fixed');
            }
            $header.removeClass('fixed');
            $header_action_btn.addClass('button--outline');
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

    $mobile_nav_toggler.on('click', function(){
        $(this).toggleClass('active');
    });

    $hero_form_toggler.on('click', function(){
        if($(window).scrollTop() > 600){
            $('html, body').animate({ scrollTop: 0 }, 'slow', function(){
                $('.hero__form').css('display', 'block');
                setTimeout(function(){
                    $('.hero__form').addClass('active');
                }, 50);
            });
        }
        else{
            $('.hero__form').css('display', 'block');
            setTimeout(function(){
                $('.hero__form').addClass('active');
            }, 50);
        }

        if($(this).parent().hasClass('menu-item-type-action')){
            $mobile_nav_toggler.removeClass('active');
        }

        return false;
    });

    $chat_toggler.on('click', function(){
        smartsupp('chat:open');
        return false;
    });

    // Bycicle
    setTimeout(function(){
        $('.elementor-tab-title.elementor-active').trigger('click');
    }, 500);
});