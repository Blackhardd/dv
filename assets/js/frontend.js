jQuery(document).ready(function($){
    // Header
    let $header = $('.site-header');

    if($(window).scrollTop() > $header.height()){
        $('body').addClass('header-fixed');
        $header.addClass('fixed');
    }

    $(window).on('scroll', function(){
        let scroll_top = $(window).scrollTop();

        if(scroll_top > $header.height()){
            $('body').addClass('header-fixed');
            $header.addClass('fixed');
        }
        else{
            $('body').removeClass('header-fixed');
            $header.removeClass('fixed');
        }
    })
});