<?php

if( !defined( 'DV_THEME_VERSION' ) ){
	define( 'DV_THEME_VERSION', '0.2' );
}


/**
 * Theme Supports
 */
add_action( 'after_setup_theme', 'dv_theme_supports' );
if( !function_exists( 'dv_theme_supports' ) ) :
    function dv_theme_supports(){
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Primary', 'dv' ),
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
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'dv_enqueue_scripts' );
function dv_enqueue_scripts(){
    wp_register_script( 'dv-multistep-form', get_template_directory_uri() . '/assets/js/multistep-form.js', array(), DV_THEME_VERSION, true );

    wp_enqueue_style( 'icofont', get_template_directory_uri() . '/assets/css/icofont.min.css', array(), DV_THEME_VERSION );
    wp_enqueue_style( 'dv-theme', get_stylesheet_uri(), array(), DV_THEME_VERSION );

    wp_enqueue_script( 'dv-frontend', get_template_directory_uri() . '/assets/js/frontend.js', array( 'jquery' ), DV_THEME_VERSION, true );
}


/**
 * Shortcodes
 */
include TEMPLATEPATH . '/inc/shortcodes.php';


/**
 * Elementor Widgets
 */
include TEMPLATEPATH . '/inc/elementor.php';


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