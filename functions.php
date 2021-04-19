<?php

if( !defined( 'DV_THEME_VERSION' ) ){
	define( 'DV_THEME_VERSION', '0.1' );
}


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