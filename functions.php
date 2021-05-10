<?php

if( !defined( 'DV_THEME_VERSION' ) ){
	define( 'DV_THEME_VERSION', '0.25a' );
}


/**
 * Theme Supports
 */
add_action( 'after_setup_theme', 'dv_theme_supports' );
if( !function_exists( 'dv_theme_supports' ) ) :
    function dv_theme_supports(){
        register_nav_menus( array(
            'primary-menu'  => esc_html__( 'Primary', 'dv' ),
            'homepage-menu' => esc_html__( 'Homepage', 'dv' )
        ) );

        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );    
    }
endif;


/**
 * Image sizes
 */
if( function_exists( 'add_image_size' ) ) :
    add_image_size( 'gallery-thumb', 200, 200, true );
endif;


/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'dv_enqueue_scripts' );
function dv_enqueue_scripts(){
    wp_register_style( 'glider', '//cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css', array(), DV_THEME_VERSION );
    wp_register_style( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), DV_THEME_VERSION );

    wp_register_script( 'glider', '//cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js', array(), DV_THEME_VERSION, true );
    wp_register_script( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array(), DV_THEME_VERSION, true );
    wp_register_script( 'dv-multistep-form', get_template_directory_uri() . '/assets/js/multistep-form.js', array(), DV_THEME_VERSION, true );

    wp_enqueue_style( 'icofont', get_template_directory_uri() . '/assets/css/icofont.min.css', array(), DV_THEME_VERSION );
    wp_enqueue_style( 'dv-theme', get_stylesheet_uri(), array(), DV_THEME_VERSION );

    wp_enqueue_script( 'dv-frontend', get_template_directory_uri() . '/assets/js/frontend.js', array( 'jquery' ), DV_THEME_VERSION, true );

    wp_localize_script( 'dv-multistep-form', '_dv', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );
}


/**
 * Helpers
 */
include TEMPLATEPATH . '/inc/helpers.php';


/**
 * AJAX
 */
include TEMPLATEPATH . '/inc/ajax.php';


/**
 * Shortcodes
 */
include TEMPLATEPATH . '/inc/shortcodes.php';


/**
 * Elementor Widgets
 */
include TEMPLATEPATH . '/inc/elementor.php';


/**
 *  Adding action button to main menu.
 */
add_filter( 'wp_nav_menu_items', 'dv_main_menu_add_action_button' );
function dv_main_menu_add_action_button( $items ){
    $button_title = __( 'Chci darovat', 'dv' );
    $button = "<li class='menu-item menu-item-type-action'><a href='#form' class='button button--outline'>{$button_title}</a></li>";

    return $items . $button;
}


/**
 *  Add scroll to top button.
 */
add_action( 'wp_footer', 'dv_add_scroll_to_top_button' );
function dv_add_scroll_to_top_button(){ ?>
        <div class="scroll-to-top">
            <button class="button button--icon">
                <i class="icofont-arrow-up"></i>
            </button>
        </div>
    <?php
}