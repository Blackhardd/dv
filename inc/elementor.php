<?php

add_action( 'init', 'dv_load_elementor_widgets' );
function dv_load_elementor_widgets(){
    if( !class_exists( 'DV_Hero_Widget' ) ) :
        require TEMPLATEPATH . '/elementor/class-dv-hero-widget.php';
    endif;

    if( !class_exists( 'DV_Steps' ) ) :
        require TEMPLATEPATH . '/elementor/class-dv-steps-widget.php';
    endif;

    if( !class_exists( 'DV_Button_Widget' ) ) :
        require TEMPLATEPATH . '/elementor/class-dv-button-widget.php';
    endif;

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new DV_Hero_Widget() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new DV_Steps() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new DV_Button_Widget() );
}